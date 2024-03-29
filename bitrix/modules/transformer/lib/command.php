<?php

namespace Bitrix\Transformer;

use Bitrix\Main\Result;
use Bitrix\Main\Error;
use Bitrix\Main\Type\DateTime;
use Bitrix\Transformer\Entity\CommandTable;
use Bitrix\Main\NotSupportedException;
use Bitrix\Main\ArgumentNullException;
use Bitrix\Main\ArgumentTypeException;
use Bitrix\Main\NotImplementedException;
use Bitrix\Main\InvalidOperationException;
use Bitrix\Main\ArgumentOutOfRangeException;
use Bitrix\Main\Loader;

/**
 * Class Command
 * @package Bitrix\Transformer
 */
class Command
{
	const STATUS_CREATE = 100;
	const STATUS_SEND = 200;
	const STATUS_UPLOAD = 300;
	const STATUS_SUCCESS = 400;
	const STATUS_ERROR = 1000;

	protected $command;
	protected $params;
	protected $status;
	protected $module;
	protected $callback;
	protected $guid;
	protected $id;
	protected $file;
	protected $time;

	/**
	 * Command constructor.
	 * @param string $command Class name of the controller.
	 * @param array $params Params to be passed.
	 * @param string|array $module Module name (one or array) to be included before callback.
	 * @param string|array $callback Callback (one or array) to be called with results.
	 * @param int $status Current status.
	 * @param string $id Primary key.
	 * @param string $guid Unique key of the command.
	 * @throws ArgumentNullException
	 */
	public function __construct($command, $params, $module, $callback, $status = self::STATUS_CREATE, $id = '', $guid = '', $time = null)
	{
		if(empty($command))
		{
			throw new ArgumentNullException('command');
		}
		if(empty($module))
		{
			throw new ArgumentNullException('module');
		}
		if(empty($callback))
		{
			throw new ArgumentNullException('callback');
		}
		$this->command = $command;
		$this->params = $params;
		$this->module = $module;
		$this->callback = $callback;
		$this->status = $status;
		$this->id = $id;
		$this->guid = $guid;
		$this->time = $time;
		if(isset($params['file']))
		{
			$this->file = $params['file'];
		}
	}

	/**
	 * @return string
	 */
	protected static function generateGuid()
	{
		return randString(10) . uniqid();
	}

	/**
	 * Check current status of the command and send it through $http.
	 *
	 * @param Http $http Class to send command.
	 * @return Result
	 * @throws NotSupportedException
	 * @throws ArgumentNullException
	 * @throws ArgumentTypeException
	 * @throws NotImplementedException
	 * @throws InvalidOperationException
	 */
	public function send(Http $http)
	{
		if($this->status != self::STATUS_CREATE)
		{
			throw new InvalidOperationException('command should be in status '.self::getStatusText(self::STATUS_CREATE));
		}
		if(empty($this->guid))
		{
			throw new InvalidOperationException('command should be saved before send');
		}
		$result = new Result();
		$response = $http->query($this->command, $this->guid, $this->params);
		if($response && $response['success'] !== false)
		{
			$this->updateStatus(self::STATUS_SEND);
			$result->setData(['commandId' => $this->id]);
		}
		else
		{
			$result = $this->processError($response['result']['msg']);
			if($response['result']['code'] == 'WRONG_COMMAND')
			{
				throw new NotSupportedException($response['result']['msg']);
			}
		}
		return $result;
	}

	/**
	 * Include modules and call all the callbacks. Return true on success of all callbacks.
	 * If at least one of callbacks returned false, this method return false.
	 *
	 * @param array $result Result from the controller.
	 * @return bool
	 */
	public function callback($result = array())
	{
		if(!is_array($this->module))
		{
			$this->module = array($this->module);
		}

		if(!is_array($this->callback))
		{
			$this->callback = array($this->callback);
		}

		foreach($this->module as $module)
		{
			if(!\Bitrix\Main\Loader::includeModule($module))
			{
				Log::write('callback cant load module '.$module);
				return false;
			}
		}
		$count = count($this->callback);
		$success = 0;
		foreach($this->callback as $callback)
		{
			if(is_a($callback, 'Bitrix\Transformer\InterfaceCallback', true))
			{
				try
				{
					/* @var $callback InterfaceCallback*/
					$resultCallback = $callback::call($this->status, $this->command, $this->params, $result);
				}
				catch(\Exception $exception)
				{
					$resultCallback = $exception->getMessage();
				}
				catch (\Error $error)
				{
					$resultCallback = $error->getMessage();
				}
				if($resultCallback === true)
				{
					$success++;
				}
				else
				{
					Log::write('Error doing callback. Result: '.$resultCallback);
				}
			}
			else
			{
				Log::write($callback.' does not implements Bitrix\Transformer\InterfaceCallback');
			}
		}
		return ($count == $success);
	}

	/**
	 * Update status of command and save it in DB.
	 *
	 * @param int $status CommandTable_STATUS.
	 * @param string $error Error to save to DB.
	 * @return \Bitrix\Main\Entity\UpdateResult
	 * @throws ArgumentOutOfRangeException
	 * @throws InvalidOperationException
	 */
	public function updateStatus($status, $error = '')
	{
		$status = intval($status);
		if(!self::getStatusText($status))
		{
			throw new ArgumentOutOfRangeException('status');
		}
		if($this->status >= $status)
		{
			throw new InvalidOperationException('new status should be greater than current');
		}
		if(!$this->id)
		{
			throw new InvalidOperationException('command should be saved before update');
		}
		Log::write('updateStatus in '.$this->guid.' from '.$this->status.' to '.$status);
		$this->status = $status;
		$data = array('STATUS' => $status, 'UPDATE_TIME' => new DateTime());
		if(!empty($error))
		{
			$data['ERROR'] = $error;
		}
		return CommandTable::update($this->id, $data);
	}

	/**
	 * Get current status of the command.
	 *
	 * @return int
	 */
	public function getStatus()
	{
		return $this->status;
	}

	/**
	 * Write error message to log, update status of the command, call callback with error status.
	 *
	 * @param string $error Error text.
	 * @return Result
	 */
	protected function processError($error)
	{
		$result = new Result();
		$result->addError(new Error($error));
		Log::write($error);
		if($this->id > 0)
		{
			$this->updateStatus(self::STATUS_ERROR, $error);
		}
		if(!empty($this->callback))
		{
			$this->callback();
		}
		return $result;
	}

	/**
	 * Get text description of the status.
	 *
	 * @param int $status Code of the status.
	 * @return int|string - status description.
	 */
	public static function getStatusText($status)
	{
		$statusList = array(
			self::STATUS_CREATE => 'create',
			self::STATUS_SEND => 'send',
			self::STATUS_UPLOAD => 'upload',
			self::STATUS_SUCCESS => 'success',
			self::STATUS_ERROR => 'error'
		);
		if(isset($statusList[$status]))
		{
			return $statusList[$status];
		}

		return false;
	}

	/**
	 * Save command in DB.
	 *
	 * @return \Bitrix\Main\Entity\AddResult
	 * @throws InvalidOperationException
	 */
	public function save()
	{
		if($this->id > 0)
		{
			throw new InvalidOperationException('command should not be saved before save');
		}
		$this->guid = self::generateGuid();
		$this->time = new DateTime();
		$commandItem = array(
			'GUID' => $this->guid,
			'STATUS' => $this->status,
			'COMMAND' => $this->command,
			'MODULE' => base64_encode(serialize($this->module)),
			'CALLBACK' => base64_encode(serialize($this->callback)),
			'PARAMS' => base64_encode(serialize($this->params)),
			'FILE' => $this->file,
			'UPDATE_TIME' => $this->time,
		);
		$addResult = CommandTable::add($commandItem);
		if($addResult->isSuccess())
		{
			$this->id = $addResult->getId();
		}
		return $addResult;
	}

	/**
	 * Get command from DB on $guid.
	 *
	 * @param string $guid Unique key to get Command from DB.
	 * @return Command|bool
	 * @throws ArgumentNullException
	 */
	public static function getByGuid($guid)
	{
		if(empty($guid))
		{
			throw new ArgumentNullException('guid');
		}
		$commandItem = CommandTable::getRow(array('filter' => array('=GUID' => $guid), 'order' => array('ID' => 'desc')));
		if($commandItem && $commandItem['ID'] > 0)
		{
			return self::initFromArray($commandItem);
		}
		return false;
	}

	/**
	 * Get last command from DB on $file.
	 *
	 * @param string $file Path to the file command had been created with.
	 * @return Command|bool
	 * @throws ArgumentNullException
	 */
	public static function getByFile($file)
	{
		if(empty($file))
		{
			throw new ArgumentNullException('file');
		}
		$commandItem = CommandTable::getRow(array('filter' => array('=FILE' => $file), 'order' => array('ID' => 'desc')));
		if($commandItem && $commandItem['ID'] > 0)
		{
			return self::initFromArray($commandItem);
		}
		return false;
	}

	/**
	 * Create new object from array.
	 *
	 * @param array $commandItem
	 * @return Command
	 */
	protected static function initFromArray($commandItem)
	{
		$commandItem['CALLBACK'] = unserialize(base64_decode($commandItem['CALLBACK']));
		$commandItem['MODULE'] = unserialize(base64_decode($commandItem['MODULE']));
		$commandItem['PARAMS'] = unserialize(base64_decode($commandItem['PARAMS']));
		$commandItem['ID'] = intval($commandItem['ID']);
		return new self($commandItem['COMMAND'], $commandItem['PARAMS'], $commandItem['MODULE'], $commandItem['CALLBACK'], $commandItem['STATUS'], $commandItem['ID'], $commandItem['GUID'], $commandItem['UPDATE_TIME']);
	}

	/**
	 * Get update time of the command.
	 *
	 * @return null|DateTime
	 */
	public function getTime()
	{
		return $this->time;
	}

	/**
	 * Get id of the command
	 *
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Adds new record to push&pull
	 */
	public function push()
	{
		if($this->id > 0 && Loader::includeModule('pull'))
		{
			\CPullWatch::AddToStack('TRANSFORMATIONCOMPLETE'.$this->id, [
				'module_id' => 'transformer',
				'command' => 'refreshPlayer',
				'params' => ['id' => $this->id],
			]);
		}
	}

	/**
	 * @return array
	 */
	public function getParams()
	{
		return $this->params;
	}
}
