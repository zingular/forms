<?php

namespace Zingular\Forms\Service\Conversion;
use Zingular\Forms\Converter;
use Zingular\Forms\Exception\FormException;
use Zingular\Forms\Plugins\Converters\ConverterInterface;
use Zingular\Forms\Plugins\Converters\InternalCallableConverter;


/**
 * Class ConverterFactory
 * @package Zingular\Forms\Service\Conversion
 */
class ConverterFactory implements ConverterFactoryInterface
{
    /**
     * @param string $type
     * @return ConverterInterface
     * @throws FormException
     */
    public function create($type)
    {
        switch($type)
        {
            case Converter::STRING_TO_TIMESTAMP: return new InternalCallableConverter(Converter::STRING_TO_TIMESTAMP,$this);
            case Converter::TIMESTAMP_TO_STRING: return new InternalCallableConverter(Converter::TIMESTAMP_TO_STRING,$this);
            case Converter::SERIALIZE: return new InternalCallableConverter(Converter::SERIALIZE,$this);
        }

        throw new FormException(sprintf("Cannot create converter: unknown converter type '%s'",$type));
    }

    /**
     * @param $value
     * @param string $format
     * @return bool|string
     */
    public function timestampToString_encode($value,$format = 'd-m-Y')
    {
        return date($format,$value);
    }

    /**
     * @param $value
     * @param string $format
     * @return int|string
     */
    public function timestampToString_decode($value,$format = 'd-m-Y')
    {
        $format = \DateTime::createFromFormat($format,$value);

        return $format === false ? '' : $format->getTimestamp();
    }

    /**
     * @param $value
     * @return string
     */
    public function serialize_encode($value)
    {
        return serialize($value);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function serialize_decode($value)
    {
        $res = @unserialize($value);

        // if unsuccessful, simply return the original value
        if($res === false && $value !== 'b:0;')
        {
            return $value;
        }

        return $res;
    }
}