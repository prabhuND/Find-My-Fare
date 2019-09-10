<?

namespace Bitrix\Pull\Protobuf;

/**
 * Generated by Protobuf protoc plugin.
 *
 * File descriptor : response.proto
 */


/**
 * Protobuf message : Response
 */
class Response extends \Protobuf\AbstractMessage
{

    /**
     * @var \Protobuf\UnknownFieldSet
     */
    protected $unknownFieldSet = null;

    /**
     * @var \Protobuf\Extension\ExtensionFieldMap
     */
    protected $extensions = null;

    /**
     * outgoingMessages optional message = 1
     *
     * @var \Bitrix\Pull\Protobuf\OutgoingMessagesResponse
     */
    protected $outgoingMessages = null;

    /**
     * channelStats optional message = 2
     *
     * @var \Bitrix\Pull\Protobuf\ChannelStatsResponse
     */
    protected $channelStats = null;

    /**
     * serverStats optional message = 3
     *
     * @var \Bitrix\Pull\Protobuf\JsonResponse
     */
    protected $serverStats = null;

    /**
     * Check if 'outgoingMessages' has a value
     *
     * @return bool
     */
    public function hasOutgoingMessages()
    {
        return $this->outgoingMessages !== null;
    }

    /**
     * Get 'outgoingMessages' value
     *
     * @return \Bitrix\Pull\Protobuf\OutgoingMessagesResponse
     */
    public function getOutgoingMessages()
    {
        return $this->outgoingMessages;
    }

    /**
     * Set 'outgoingMessages' value
     *
     * @param \Bitrix\Pull\Protobuf\OutgoingMessagesResponse $value
     */
    public function setOutgoingMessages(\Bitrix\Pull\Protobuf\OutgoingMessagesResponse $value = null)
    {
        $this->outgoingMessages = $value;
    }

    /**
     * Check if 'channelStats' has a value
     *
     * @return bool
     */
    public function hasChannelStats()
    {
        return $this->channelStats !== null;
    }

    /**
     * Get 'channelStats' value
     *
     * @return \Bitrix\Pull\Protobuf\ChannelStatsResponse
     */
    public function getChannelStats()
    {
        return $this->channelStats;
    }

    /**
     * Set 'channelStats' value
     *
     * @param \Bitrix\Pull\Protobuf\ChannelStatsResponse $value
     */
    public function setChannelStats(\Bitrix\Pull\Protobuf\ChannelStatsResponse $value = null)
    {
        $this->channelStats = $value;
    }

    /**
     * Check if 'serverStats' has a value
     *
     * @return bool
     */
    public function hasServerStats()
    {
        return $this->serverStats !== null;
    }

    /**
     * Get 'serverStats' value
     *
     * @return \Bitrix\Pull\Protobuf\JsonResponse
     */
    public function getServerStats()
    {
        return $this->serverStats;
    }

    /**
     * Set 'serverStats' value
     *
     * @param \Bitrix\Pull\Protobuf\JsonResponse $value
     */
    public function setServerStats(\Bitrix\Pull\Protobuf\JsonResponse $value = null)
    {
        $this->serverStats = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function extensions()
    {
        if ( $this->extensions !== null) {
            return $this->extensions;
        }

        return $this->extensions = new \Protobuf\Extension\ExtensionFieldMap(__CLASS__);
    }

    /**
     * {@inheritdoc}
     */
    public function unknownFieldSet()
    {
        return $this->unknownFieldSet;
    }

    /**
     * {@inheritdoc}
     */
    public static function fromStream($stream, \Protobuf\Configuration $configuration = null)
    {
        return new self($stream, $configuration);
    }

    /**
     * {@inheritdoc}
     */
    public static function fromArray(array $values)
    {
        $message = new self();
        $values  = array_merge([
            'outgoingMessages' => null,
            'channelStats' => null,
            'serverStats' => null
        ], $values);

        $message->setOutgoingMessages($values['outgoingMessages']);
        $message->setChannelStats($values['channelStats']);
        $message->setServerStats($values['serverStats']);

        return $message;
    }

    /**
     * {@inheritdoc}
     */
    public static function descriptor()
    {
        return \google\protobuf\DescriptorProto::fromArray([
            'name'      => 'Response',
            'field'     => [
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 1,
                    'name' => 'outgoingMessages',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_MESSAGE(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL(),
                    'type_name' => '.OutgoingMessagesResponse'
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 2,
                    'name' => 'channelStats',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_MESSAGE(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL(),
                    'type_name' => '.ChannelStatsResponse'
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 3,
                    'name' => 'serverStats',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_MESSAGE(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL(),
                    'type_name' => '.JsonResponse'
                ]),
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function toStream(\Protobuf\Configuration $configuration = null)
    {
        $config  = $configuration ?: \Protobuf\Configuration::getInstance();
        $context = $config->createWriteContext();
        $stream  = $context->getStream();

        $this->writeTo($context);
        $stream->seek(0);

        return $stream;
    }

    /**
     * {@inheritdoc}
     */
    public function writeTo(\Protobuf\WriteContext $context)
    {
        $stream      = $context->getStream();
        $writer      = $context->getWriter();
        $sizeContext = $context->getComputeSizeContext();

        if ($this->outgoingMessages !== null) {
            $writer->writeVarint($stream, 10);
            $writer->writeVarint($stream, $this->outgoingMessages->serializedSize($sizeContext));
            $this->outgoingMessages->writeTo($context);
        }

        if ($this->channelStats !== null) {
            $writer->writeVarint($stream, 18);
            $writer->writeVarint($stream, $this->channelStats->serializedSize($sizeContext));
            $this->channelStats->writeTo($context);
        }

        if ($this->serverStats !== null) {
            $writer->writeVarint($stream, 26);
            $writer->writeVarint($stream, $this->serverStats->serializedSize($sizeContext));
            $this->serverStats->writeTo($context);
        }

        if ($this->extensions !== null) {
            $this->extensions->writeTo($context);
        }

        return $stream;
    }

    /**
     * {@inheritdoc}
     */
    public function readFrom(\Protobuf\ReadContext $context)
    {
        $reader = $context->getReader();
        $length = $context->getLength();
        $stream = $context->getStream();

        $limit = ($length !== null)
            ? ($stream->tell() + $length)
            : null;

        while ($limit === null || $stream->tell() < $limit) {

            if ($stream->eof()) {
                break;
            }

            $key  = $reader->readVarint($stream);
            $wire = \Protobuf\WireFormat::getTagWireType($key);
            $tag  = \Protobuf\WireFormat::getTagFieldNumber($key);

            if ($stream->eof()) {
                break;
            }

            if ($tag === 1) {
                \Protobuf\WireFormat::assertWireType($wire, 11);

                $innerSize    = $reader->readVarint($stream);
                $innerMessage = new \Bitrix\Pull\Protobuf\OutgoingMessagesResponse();

                $this->outgoingMessages = $innerMessage;

                $context->setLength($innerSize);
                $innerMessage->readFrom($context);
                $context->setLength($length);

                continue;
            }

            if ($tag === 2) {
                \Protobuf\WireFormat::assertWireType($wire, 11);

                $innerSize    = $reader->readVarint($stream);
                $innerMessage = new \Bitrix\Pull\Protobuf\ChannelStatsResponse();

                $this->channelStats = $innerMessage;

                $context->setLength($innerSize);
                $innerMessage->readFrom($context);
                $context->setLength($length);

                continue;
            }

            if ($tag === 3) {
                \Protobuf\WireFormat::assertWireType($wire, 11);

                $innerSize    = $reader->readVarint($stream);
                $innerMessage = new \Bitrix\Pull\Protobuf\JsonResponse();

                $this->serverStats = $innerMessage;

                $context->setLength($innerSize);
                $innerMessage->readFrom($context);
                $context->setLength($length);

                continue;
            }

            $extensions = $context->getExtensionRegistry();
            $extension  = $extensions ? $extensions->findByNumber(__CLASS__, $tag) : null;

            if ($extension !== null) {
                $this->extensions()->add($extension, $extension->readFrom($context, $wire));

                continue;
            }

            if ($this->unknownFieldSet === null) {
                $this->unknownFieldSet = new \Protobuf\UnknownFieldSet();
            }

            $data    = $reader->readUnknown($stream, $wire);
            $unknown = new \Protobuf\Unknown($tag, $wire, $data);

            $this->unknownFieldSet->add($unknown);

        }
    }

    /**
     * {@inheritdoc}
     */
    public function serializedSize(\Protobuf\ComputeSizeContext $context)
    {
        $calculator = $context->getSizeCalculator();
        $size       = 0;

        if ($this->outgoingMessages !== null) {
            $innerSize = $this->outgoingMessages->serializedSize($context);

            $size += 1;
            $size += $innerSize;
            $size += $calculator->computeVarintSize($innerSize);
        }

        if ($this->channelStats !== null) {
            $innerSize = $this->channelStats->serializedSize($context);

            $size += 1;
            $size += $innerSize;
            $size += $calculator->computeVarintSize($innerSize);
        }

        if ($this->serverStats !== null) {
            $innerSize = $this->serverStats->serializedSize($context);

            $size += 1;
            $size += $innerSize;
            $size += $calculator->computeVarintSize($innerSize);
        }

        if ($this->extensions !== null) {
            $size += $this->extensions->serializedSize($context);
        }

        return $size;
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        $this->outgoingMessages = null;
        $this->channelStats = null;
        $this->serverStats = null;
    }

    /**
     * {@inheritdoc}
     */
    public function merge(\Protobuf\Message $message)
    {
        if ( ! $message instanceof \Bitrix\Pull\Protobuf\Response) {
            throw new \InvalidArgumentException(sprintf('Argument 1 passed to %s must be a %s, %s given', __METHOD__, __CLASS__, get_class($message)));
        }

        $this->outgoingMessages = ($message->outgoingMessages !== null) ? $message->outgoingMessages : $this->outgoingMessages;
        $this->channelStats = ($message->channelStats !== null) ? $message->channelStats : $this->channelStats;
        $this->serverStats = ($message->serverStats !== null) ? $message->serverStats : $this->serverStats;
    }


}
