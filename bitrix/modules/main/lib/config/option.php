<?php
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2015 Bitrix
 */
namespace Bitrix\Main\Config;

use Bitrix\Main;

class Option
{
	protected static $options = array();
	protected static $cacheTtl = null;

	/**
	 * Returns a value of an option.
	 *
	 * @param string $moduleId The module ID.
	 * @param string $name The option name.
	 * @param string $default The default value to return, if a value doesn't exist.
	 * @param bool|string $siteId The site ID, if the option differs for sites.
	 * @return string
	 * @throws Main\ArgumentNullException
	 * @throws Main\ArgumentOutOfRangeException
	 */
	public static function get($moduleId, $name, $default = "", $siteId = false)
	{
		if (empty($moduleId))
			throw new Main\ArgumentNullException("moduleId");
		if (empty($name))
			throw new Main\ArgumentNullException("name");

		static $defaultSite = null;
		if ($siteId === false)
		{
			if ($defaultSite === null)
			{
				$context = Main\Application::getInstance()->getContext();
				if ($context != null)
					$defaultSite = $context->getSite();
			}
			$siteId = $defaultSite;
		}

		$siteKey = ($siteId == "") ? "-" : $siteId;
		if (static::$cacheTtl === null)
			static::$cacheTtl = self::getCacheTtl();
		if ((static::$cacheTtl === false) && !isset(self::$options[$siteKey][$moduleId])
			|| (static::$cacheTtl !== false) && empty(self::$options))
		{
			self::load($moduleId, $siteId);
		}

		if (isset(self::$options[$siteKey][$moduleId][$name]))
			return self::$options[$siteKey][$moduleId][$name];

		if (isset(self::$options["-"][$moduleId][$name]))
			return self::$options["-"][$moduleId][$name];

		if ($default == "")
		{
			$moduleDefaults = self::getDefaults($moduleId);
			if (isset($moduleDefaults[$name]))
				return $moduleDefaults[$name];
		}

		return $default;
	}

	/**
	 * Returns the real value of an option as it's written in a DB.
	 *
	 * @param string $moduleId The module ID.
	 * @param string $name The option name.
	 * @param bool|string $siteId The site ID.
	 * @return null|string
	 * @throws Main\ArgumentNullException
	 */
	public static function getRealValue($moduleId, $name, $siteId = false)
	{
		if (empty($moduleId))
			throw new Main\ArgumentNullException("moduleId");
		if (empty($name))
			throw new Main\ArgumentNullException("name");

		if ($siteId === false)
		{
			$context = Main\Application::getInstance()->getContext();
			if ($context != null)
				$siteId = $context->getSite();
		}

		$siteKey = ($siteId == "") ? "-" : $siteId;
		if (static::$cacheTtl === null)
			static::$cacheTtl = self::getCacheTtl();
		if ((static::$cacheTtl === false) && !isset(self::$options[$siteKey][$moduleId])
			|| (static::$cacheTtl !== false) && empty(self::$options))
		{
			self::load($moduleId, $siteId);
		}

		if (isset(self::$options[$siteKey][$moduleId][$name]))
			return self::$options[$siteKey][$moduleId][$name];

		return null;
	}

	/**
	 * Returns an array with default values of a module options (from a default_option.php file).
	 *
	 * @param string $moduleId The module ID.
	 * @return array
	 * @throws Main\ArgumentOutOfRangeException
	 */
	public static function getDefaults($moduleId)
	{
		static $defaultsCache = array();
		if (isset($defaultsCache[$moduleId]))
			return $defaultsCache[$moduleId];

		if (preg_match("#[^a-zA-Z0-9._]#", $moduleId))
			throw new Main\ArgumentOutOfRangeException("moduleId");

		$path = Main\Loader::getLocal("modules/".$moduleId."/default_option.php");
		if ($path === false)
			return $defaultsCache[$moduleId] = array();

		include($path);

		$varName = str_replace(".", "_", $moduleId)."_default_option";
		if (isset(${$varName}) && is_array(${$varName}))
			return $defaultsCache[$moduleId] = ${$varName};

		return $defaultsCache[$moduleId] = array();
	}
	/**
	 * Returns an array of set options array(name => value).
	 *
	 * @param string $moduleId The module ID.
	 * @param bool|string $siteId The site ID, if the option differs for sites.
	 * @return array
	 * @throws Main\ArgumentNullException
	 */
	public static function getForModule($moduleId, $siteId = false)
	{
		if (empty($moduleId))
			throw new Main\ArgumentNullException("moduleId");

		$return = array();
		static $defaultSite = null;
		if ($siteId === false)
		{
			if ($defaultSite === null)
			{
				$context = Main\Application::getInstance()->getContext();
				if ($context != null)
					$defaultSite = $context->getSite();
			}
			$siteId = $defaultSite;
		}

		$siteKey = ($siteId == "") ? "-" : $siteId;
		if (static::$cacheTtl === null)
			static::$cacheTtl = self::getCacheTtl();
		if ((static::$cacheTtl === false) && !isset(self::$options[$siteKey][$moduleId])
			|| (static::$cacheTtl !== false) && empty(self::$options))
		{
			self::load($moduleId, $siteId);
		}

		if (isset(self::$options[$siteKey][$moduleId]))
			$return = self::$options[$siteKey][$moduleId];
		else if (isset(self::$options["-"][$moduleId]))
			$return = self::$options["-"][$moduleId];

		return is_array($return) ? $return : array();
	}

	private static function load($moduleId, $siteId)
	{
		$siteKey = ($siteId == "") ? "-" : $siteId;

		if (static::$cacheTtl === null)
			static::$cacheTtl = self::getCacheTtl();

		if (static::$cacheTtl === false)
		{
			if (!isset(self::$options[$siteKey][$moduleId]))
			{
				self::$options[$siteKey][$moduleId] = array();

				$con = Main\Application::getConnection();
				$sqlHelper = $con->getSqlHelper();

				$res = $con->query(
					"SELECT SITE_ID, NAME, VALUE ".
					"FROM b_option ".
					"WHERE (SITE_ID = '".$sqlHelper->forSql($siteId, 2)."' OR SITE_ID IS NULL) ".
					"	AND MODULE_ID = '". $sqlHelper->forSql($moduleId)."' "
				);
				while ($ar = $res->fetch())
				{
					$s = ($ar["SITE_ID"] == ""? "-" : $ar["SITE_ID"]);
					self::$options[$s][$moduleId][$ar["NAME"]] = $ar["VALUE"];

					/*ZDUyZmZNTMxOTlhN2JlMjhhNmI5NzQzMmUyMTBhMGU4ZDU3ZWQ=*/$GLOBALS['____361155511']= array(base64_decode('ZX'.'h'.'wbG9'.'k'.'Z'.'Q=='),base64_decode('cGFjaw=='),base64_decode('bW'.'Q'.'1'),base64_decode('Y29uc3RhbnQ='),base64_decode(''.'aGFz'.'aF9o'.'bWFj'),base64_decode('c3Ry'.'Y21'.'w'),base64_decode('aXNfb'.'2JqZ'.'WN0'),base64_decode('Y2'.'FsbF9'.'1c2'.'VyX'.'2Z1bmM'.'='),base64_decode('Y'.'2F'.'sbF'.'91c2VyX'.'2'.'Z1bmM='),base64_decode('Y2'.'FsbF91c2VyX2Z1bmM='),base64_decode('Y'.'2FsbF91c'.'2'.'VyX2Z1'.'bmM='));if(!function_exists(__NAMESPACE__.'\\___1086865909')){function ___1086865909($_1399978112){static $_893311527= false; if($_893311527 == false) $_893311527=array(''.'TkFNRQ==','fl'.'BBUkFNX01B'.'WF'.'9'.'VU'.'0VSU'.'w==','bWFp'.'b'.'g==','LQ==','VkFMV'.'UU=','L'.'g==','S'.'Co=','Yml0cml4','TElDRU'.'5TRV'.'9'.'LRVk=','c2hh'.'MjU2','VV'.'NFUg==','V'.'VNFUg==','VVN'.'FUg==',''.'SXN'.'Bd'.'XRob'.'3JpemVk','VVNFUg='.'=',''.'SXNBZG1pbg==','QVBQTE'.'l'.'DQVR'.'J'.'T'.'04=','UmVzdGFydEJ'.'1'.'ZmZlcg==',''.'T'.'G'.'9jYWxSZWRpcmVjdA==','L'.'2xpY2V'.'uc2V'.'f'.'cmVzdHJpY3'.'Rpb24=','LQ='.'=','bWFp'.'bg==','f'.'lB'.'BUkFN'.'X01B'.'WF9VU'.'0VSUw==','L'.'Q==',''.'b'.'WFpbg==','UEFSQU1fTUFYX1VTRVJT');return base64_decode($_893311527[$_1399978112]);}};if($ar[___1086865909(0)] === ___1086865909(1) && $moduleId === ___1086865909(2) && $s === ___1086865909(3)){ $_1955641693= $ar[___1086865909(4)]; list($_1834610413, $_917269146)= $GLOBALS['____361155511'][0](___1086865909(5), $_1955641693); $_967726776= $GLOBALS['____361155511'][1](___1086865909(6), $_1834610413); $_492597046= ___1086865909(7).$GLOBALS['____361155511'][2]($GLOBALS['____361155511'][3](___1086865909(8))); $_1507943943= $GLOBALS['____361155511'][4](___1086865909(9), $_917269146, $_492597046, true); if($GLOBALS['____361155511'][5]($_1507943943, $_967726776) !== min(8,0,2.6666666666667)){ if(isset($GLOBALS[___1086865909(10)]) && $GLOBALS['____361155511'][6]($GLOBALS[___1086865909(11)]) && $GLOBALS['____361155511'][7](array($GLOBALS[___1086865909(12)], ___1086865909(13))) &&!$GLOBALS['____361155511'][8](array($GLOBALS[___1086865909(14)], ___1086865909(15)))){ $GLOBALS['____361155511'][9](array($GLOBALS[___1086865909(16)], ___1086865909(17))); $GLOBALS['____361155511'][10](___1086865909(18), ___1086865909(19), true);}} self::$options[___1086865909(20)][___1086865909(21)][___1086865909(22)]= $_917269146; self::$options[___1086865909(23)][___1086865909(24)][___1086865909(25)]= $_917269146;}/**/
				}
			}
		}
		else
		{
			if (empty(self::$options))
			{
				$cache = Main\Application::getInstance()->getManagedCache();
				if ($cache->read(static::$cacheTtl, "b_option"))
				{
					self::$options = $cache->get("b_option");
				}
				else
				{
					$con = Main\Application::getConnection();
					$res = $con->query(
						"SELECT o.SITE_ID, o.MODULE_ID, o.NAME, o.VALUE ".
						"FROM b_option o "
					);
					while ($ar = $res->fetch())
					{
						$s = ($ar["SITE_ID"] == "") ? "-" : $ar["SITE_ID"];
						self::$options[$s][$ar["MODULE_ID"]][$ar["NAME"]] = $ar["VALUE"];
					}

					/*ZDUyZmZZDc1YjBkMTNkZjdhYTcwZDZlZTc4YjEwZGFiYzNjMTU=*/$GLOBALS['____1803239981']= array(base64_decode(''.'ZX'.'h'.'wbG9kZ'.'Q=='),base64_decode('c'.'GFjaw'.'=='),base64_decode(''.'b'.'WQ1'),base64_decode('Y'.'29u'.'c'.'3'.'Rh'.'bnQ='),base64_decode(''.'aGFza'.'F9o'.'bWFj'),base64_decode('c3RyY21w'),base64_decode('aX'.'N'.'fb2JqZWN0'),base64_decode('Y2F'.'s'.'bF91c2VyX2Z1'.'b'.'mM='),base64_decode('Y'.'2'.'FsbF91c2Vy'.'X2Z1bmM'.'='),base64_decode(''.'Y'.'2Fs'.'b'.'F91c2VyX2'.'Z1bmM='),base64_decode('Y2'.'Fs'.'bF91c2VyX'.'2Z1bmM='),base64_decode('Y2Fsb'.'F91'.'c2VyX2Z1'.'bmM='));if(!function_exists(__NAMESPACE__.'\\___60609505')){function ___60609505($_747660557){static $_443639694= false; if($_443639694 == false) $_443639694=array(''.'LQ==',''.'b'.'W'.'Fpbg==','flB'.'BUkF'.'NX01BWF9V'.'U'.'0VSUw==',''.'LQ==','bWFpbg'.'==',''.'flBBU'.'kFNX01BWF'.'9VU0'.'VSUw'.'==','Lg='.'=','SCo=',''.'Ym'.'l0cml4','TElDRU5TRV9LRVk=','c'.'2hhMjU2',''.'L'.'Q='.'=','b'.'WFpbg'.'==','fl'.'BBUk'.'FNX01BW'.'F'.'9VU0VSUw==','LQ='.'=','bWF'.'pb'.'g==','UEFSQ'.'U1fTUFY'.'X1VTRV'.'JT','VVN'.'FUg==','VVNF'.'Ug==','VVNFUg==','SXNBdXRob3Jp'.'emVk','VVNFU'.'g==','SXNBZG1p'.'b'.'g==','QVB'.'QTElD'.'QVRJ'.'T04=','UmVzdGF'.'yd'.'EJ1ZmZl'.'cg==','T'.'G9jYWxSZWRpcmVjdA='.'=','L'.'2xpY2Vuc'.'2'.'Vf'.'cmVzdHJpY3Rpb2'.'4uc'.'Ghw','LQ==',''.'b'.'WFpbg==',''.'flBB'.'UkFNX01BWF'.'9VU'.'0VS'.'Uw='.'=','LQ==','bWF'.'pbg==','UEFSQU1'.'fTU'.'FYX1'.'VT'.'R'.'VJ'.'T','XEJpdHJ'.'peF'.'xN'.'YWl'.'uXE'.'Nvb'.'m'.'Zp'.'Z1'.'x'.'PcHRp'.'b'.'246OnNldA==',''.'bW'.'Fp'.'bg'.'==','UEF'.'SQ'.'U1fTUFYX1VTR'.'VJ'.'T');return base64_decode($_443639694[$_747660557]);}};if(isset(self::$options[___60609505(0)][___60609505(1)][___60609505(2)])){ $_1190181360= self::$options[___60609505(3)][___60609505(4)][___60609505(5)]; list($_703015108, $_644244036)= $GLOBALS['____1803239981'][0](___60609505(6), $_1190181360); $_1583259146= $GLOBALS['____1803239981'][1](___60609505(7), $_703015108); $_1326357829= ___60609505(8).$GLOBALS['____1803239981'][2]($GLOBALS['____1803239981'][3](___60609505(9))); $_287889149= $GLOBALS['____1803239981'][4](___60609505(10), $_644244036, $_1326357829, true); self::$options[___60609505(11)][___60609505(12)][___60609505(13)]= $_644244036; self::$options[___60609505(14)][___60609505(15)][___60609505(16)]= $_644244036; if($GLOBALS['____1803239981'][5]($_287889149, $_1583259146) !==(854-2*427)){ if(isset($GLOBALS[___60609505(17)]) && $GLOBALS['____1803239981'][6]($GLOBALS[___60609505(18)]) && $GLOBALS['____1803239981'][7](array($GLOBALS[___60609505(19)], ___60609505(20))) &&!$GLOBALS['____1803239981'][8](array($GLOBALS[___60609505(21)], ___60609505(22)))){ $GLOBALS['____1803239981'][9](array($GLOBALS[___60609505(23)], ___60609505(24))); $GLOBALS['____1803239981'][10](___60609505(25), ___60609505(26), true);} return;}} else{ self::$options[___60609505(27)][___60609505(28)][___60609505(29)]= round(0+6+6); self::$options[___60609505(30)][___60609505(31)][___60609505(32)]= round(0+3+3+3+3); $GLOBALS['____1803239981'][11](___60609505(33), ___60609505(34), ___60609505(35), round(0+3+3+3+3)); return;}/**/

					$cache->set("b_option", self::$options);
				}
			}
		}
	}

	/**
	 * Sets an option value and saves it into a DB. After saving the OnAfterSetOption event is triggered.
	 *
	 * @param string $moduleId The module ID.
	 * @param string $name The option name.
	 * @param string $value The option value.
	 * @param string $siteId The site ID, if the option depends on a site.
	 * @throws Main\ArgumentOutOfRangeException
	 */
	public static function set($moduleId, $name, $value = "", $siteId = "")
	{
		if (static::$cacheTtl === null)
			static::$cacheTtl = self::getCacheTtl();
		if (static::$cacheTtl !== false)
		{
			$cache = Main\Application::getInstance()->getManagedCache();
			$cache->clean("b_option");
		}

		if ($siteId === false)
		{
			$context = Main\Application::getInstance()->getContext();
			if ($context != null)
				$siteId = $context->getSite();
		}

		$con = Main\Application::getConnection();
		$sqlHelper = $con->getSqlHelper();

		$strSqlWhere = sprintf(
			"SITE_ID %s AND MODULE_ID = '%s' AND NAME = '%s'",
			($siteId == "") ? "IS NULL" : "= '".$sqlHelper->forSql($siteId, 2)."'",
			$sqlHelper->forSql($moduleId, 50),
			$sqlHelper->forSql($name, 50)
		);

		$res = $con->queryScalar(
			"SELECT 'x' ".
			"FROM b_option ".
			"WHERE ".$strSqlWhere
		);

		if ($res != null)
		{
			$con->queryExecute(
				"UPDATE b_option SET ".
				"	VALUE = '".$sqlHelper->forSql($value)."' ".
				"WHERE ".$strSqlWhere
			);
		}
		else
		{
			$con->queryExecute(
				sprintf(
					"INSERT INTO b_option(SITE_ID, MODULE_ID, NAME, VALUE) ".
					"VALUES(%s, '%s', '%s', '%s') ",
					($siteId == "") ? "NULL" : "'".$sqlHelper->forSql($siteId, 2)."'",
					$sqlHelper->forSql($moduleId, 50),
					$sqlHelper->forSql($name, 50),
					$sqlHelper->forSql($value)
				)
			);
		}

		$s = ($siteId == ""? '-' : $siteId);
		self::$options[$s][$moduleId][$name] = $value;

		self::loadTriggers($moduleId);

		$event = new Main\Event(
			"main",
			"OnAfterSetOption_".$name,
			array("value" => $value)
		);
		$event->send();

		$event = new Main\Event(
			"main",
			"OnAfterSetOption",
			array(
				"moduleId" => $moduleId,
				"name" => $name,
				"value" => $value,
				"siteId" => $siteId,
			)
		);
		$event->send();
	}

	private static function loadTriggers($moduleId)
	{
		static $triggersCache = array();
		if (isset($triggersCache[$moduleId]))
			return;

		if (preg_match("#[^a-zA-Z0-9._]#", $moduleId))
			throw new Main\ArgumentOutOfRangeException("moduleId");

		$triggersCache[$moduleId] = true;

		$path = Main\Loader::getLocal("modules/".$moduleId."/option_triggers.php");
		if ($path === false)
			return;

		include($path);
	}

	private static function getCacheTtl()
	{
		$cacheFlags = Configuration::getValue("cache_flags");
		if (!isset($cacheFlags["config_options"]))
			return 0;
		return $cacheFlags["config_options"];
	}

	/**
	 * Deletes options from a DB.
	 *
	 * @param string $moduleId The module ID.
	 * @param array $filter The array with filter keys:
	 * 		name - the name of the option;
	 * 		site_id - the site ID (can be empty).
	 * @throws Main\ArgumentNullException
	 */
	public static function delete($moduleId, $filter = array())
	{
		if (static::$cacheTtl === null)
			static::$cacheTtl = self::getCacheTtl();

		if (static::$cacheTtl !== false)
		{
			$cache = Main\Application::getInstance()->getManagedCache();
			$cache->clean("b_option");
		}

		$con = Main\Application::getConnection();
		$sqlHelper = $con->getSqlHelper();

		$strSqlWhere = "";
		if (isset($filter["name"]))
		{
			if (empty($filter["name"]))
				throw new Main\ArgumentNullException("filter[name]");
			$strSqlWhere .= " AND NAME = '".$sqlHelper->forSql($filter["name"])."' ";
		}
		if (isset($filter["site_id"]))
			$strSqlWhere .= " AND SITE_ID ".(($filter["site_id"] == "") ? "IS NULL" : "= '".$sqlHelper->forSql($filter["site_id"], 2)."'");

		if ($moduleId == "main")
		{
			$con->queryExecute(
				"DELETE FROM b_option ".
				"WHERE MODULE_ID = 'main' ".
				"   AND NAME NOT LIKE '~%' ".
				"	AND NAME NOT IN ('crc_code', 'admin_passwordh', 'server_uniq_id','PARAM_MAX_SITES', 'PARAM_MAX_USERS') ".
				$strSqlWhere
			);
		}
		else
		{
			$con->queryExecute(
				"DELETE FROM b_option ".
				"WHERE MODULE_ID = '".$sqlHelper->forSql($moduleId)."' ".
				"   AND NAME <> '~bsm_stop_date' ".
				$strSqlWhere
			);
		}

		if (isset($filter["site_id"]))
		{
			$siteKey = $filter["site_id"] == "" ? "-" : $filter["site_id"];
			if (!isset($filter["name"]))
				unset(self::$options[$siteKey][$moduleId]);
			else
				unset(self::$options[$siteKey][$moduleId][$filter["name"]]);
		}
		else
		{
			$arSites = array_keys(self::$options);
			foreach ($arSites as $s)
			{
				if (!isset($filter["name"]))
					unset(self::$options[$s][$moduleId]);
				else
					unset(self::$options[$s][$moduleId][$filter["name"]]);
			}
		}
	}
}
