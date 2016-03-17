<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 17-3-2016
 * Time: 19:18
 */

namespace Zingular\Forms\Plugins\Converters;

/**
 * Class CallableConverter
 * @package Zingular\Forms\Plugins\Converters
 */
class CallableConverter implements ConverterInterface
{
    /**
     * @var callable
     */
    protected $encodeCallback;

    /**
     * @var callable
     */
    protected $decodeCallback;

    /**
     * @param callable $encodeCallback
     * @param callable $decodeCallback
     */
    public function __construct($encodeCallback,$decodeCallback)
    {
        $this->encodeCallback = $encodeCallback;
        $this->decodeCallback = $decodeCallback;
    }

    /**
     * @param $value
     * @param array $params
     * @return mixed
     */
    public function encode($value, array $params = array())
    {
        array_unshift($params,$value);
        return call_user_func_array($this->encodeCallback,$params);
    }

    /**
     * @param $value
     * @param array $params
     * @return mixed
     */
    public function decode($value, array $params = array())
    {
        array_unshift($params,$value);
        return call_user_func_array($this->decodeCallback,$params);
    }
}