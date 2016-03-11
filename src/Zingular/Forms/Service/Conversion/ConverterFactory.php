<?php

namespace Zingular\Forms\Service\Conversion;
use Zingular\Forms\Converter;
use Zingular\Forms\Exception\FormException;
use Zingular\Forms\Plugins\Converters\ConverterInterface;
use Zingular\Forms\Plugins\Converters\SerializeConverter;
use Zingular\Forms\Plugins\Converters\StringToTimestampConverter;
use Zingular\Forms\Plugins\TimestampToStringConverter;

/**
 * Class ConverterFactory
 * @package Zingular\Forms\Service\Conversion
 */
class ConverterFactory implements ConverterFactoryInterface
{
    /**
     * @var array
     */
    protected $types = array
    (
        Converter::STRING_TO_TIMESTAMP,
        Converter::TIMESTAMP_TO_STRING,
        Converter::SERIALIZE
    );

    /**
     * @param string $type
     * @return ConverterInterface
     * @throws FormException
     */
    public function create($type)
    {
        switch($type)
        {
            case Converter::STRING_TO_TIMESTAMP: return new StringToTimestampConverter();
            case Converter::TIMESTAMP_TO_STRING: return new TimestampToStringConverter();
            case Converter::SERIALIZE: return new SerializeConverter();
            default: throw new FormException(sprintf("Cannot create converter: unknown converter type '%s'",$type));
        }
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has($name)
    {
        return in_array($name,$this->types);
    }
}