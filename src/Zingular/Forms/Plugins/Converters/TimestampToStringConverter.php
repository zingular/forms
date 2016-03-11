<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 11-3-2016
 * Time: 22:32
 */

namespace Zingular\Forms\Plugins;


use Zingular\Forms\Converter;
use Zingular\Forms\Plugins\Converters\ConverterInterface;

/**
 * Class TimestampToStringConverter
 * @package Zingular\Forms\Plugins
 */
class TimestampToStringConverter implements ConverterInterface
{
    /**
     * @param $value
     * @param array ...$params
     * @return string
     */
    public function encode($value, ...$params)
    {
        return date('d-m-Y',$value);
    }

    /**
     * @param $value
     * @param $params
     * @return int
     */
    public function decode($value, ...$params)
    {
        $format = \DateTime::createFromFormat('d-m-Y',$value);

        return $format === false ? '' : $format->getTimestamp();
    }

    /**
     * @return string
     */
    public function getName()
    {
        Converter::TIMESTAMP_TO_STRING;
    }
}