<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 12-3-2016
 * Time: 12:25
 */

namespace Zingular\Forms\Plugins;

use Zingular\Forms\Plugins\Converters\ConverterInterface;

/**
 * Class CallableConverter
 * @package Zingular\Forms\Plugins
 */
class CallableConverter implements ConverterInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var callable
     */
    protected $encodeCallback;

    /**
     * @var callable
     */
    protected $decodeCallback;

    /**
     * @param string $name
     * @param callable $encodeCallback
     * @param callable $decodeCallback
     */
    public function __construct($name,$encodeCallback,$decodeCallback)
    {
        $this->name = $name;
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

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}