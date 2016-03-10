<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 10-3-2016
 * Time: 18:20
 */

namespace Zingular\Forms\Component;
use Zingular\Forms\Plugins\Converters\ConverterInterface;
use Zingular\Forms\Service\Conversion\ConverterConfig;

/**
 * Class ConvertableTrait
 * @package Zingular\Forms\Component
 */
trait ConvertableTrait
{
    /**
     * @var ConverterConfig
     */
    protected $converterConfig;

    /**
     * @var ConverterInterface
     */
    protected $converter;

    /**
     * @param $converter
     * @param $params
     * @return $this
     */
    public function setConverter($converter,...$params)
    {
        $this->converter = null;
        $this->converterConfig = new ConverterConfig($converter,$params);
        return $this;
    }

    /**
     * @return ConverterInterface
     */
    protected function getConverter()
    {
        if(is_null($this->converter) && !is_null($this->converterConfig))
        {
            $this->converter = $this->getServices()->getConverters()->get($this->converterConfig->getType());
        }

        return $this->converter;
    }

    /**
     * @param $value
     * @return mixed
     */
    protected function decodeValue($value)
    {
        if(!is_null($this->getConverter()))
        {
            return $this->getConverter()->decode($value,$this->converterConfig->getArgs());
        }

        return $value;
    }

    /**
     * @param $value
     * @return mixed
     */
    protected function encodeValue($value)
    {
        if(!is_null($this->getConverter()))
        {
            return $this->getConverter()->encode($value,$this->converterConfig->getArgs());
        }

        return $value;
    }
}