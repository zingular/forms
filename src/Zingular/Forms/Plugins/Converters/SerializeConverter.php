<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 24-2-2016
 * Time: 19:45
 */

namespace Zingular\Forms\Plugins\Converters;

use Zingular\Forms\Converter;


/**
 * Class SerializeConverter
 * @package Zingular\Forms\Service\Conversion
 */
class SerializeConverter implements ConverterInterface
{
    /**
     * @param $value
     * @param ...$params
     * @return mixed
     */
    public function encode($value, ...$params)
    {
        return serialize($value);
    }

    /**
     * @param $value
     * @param $params
     * @return mixed
     */
    public function decode($value, ...$params)
    {
        $res = @unserialize($value);

        // if unsuccessful, simply return the original value
        if($res === false && $value !== 'b:0;')
        {
            return $value;
        }

        return $res;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return Converter::SERIALIZE;
    }
}