<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 24-2-2016
 * Time: 19:29
 */

namespace Zingular\Forms\Service\Conversion;
use Zingular\Forms\Converter;

/**
 * Class StringToTimestampConverter
 * @package Zingular\Forms\Service\Conversion
 */
class StringToTimestampConverter implements ConverterInterface
{
    /**
     * @param $value
     * @param ...$params
     * @return mixed
     */
    public function encode($value, ...$params)
    {
        // TODO: Implement encode() method.
    }

    /**
     * @param $value
     * @param $params
     * @return mixed
     */
    public function decode($value, ...$params)
    {
        // TODO: Implement decode() method.
    }

    /**
     * @return string
     */
    public function getName()
    {
        return Converter::STRING_TO_TIMESTAMP;
    }
}