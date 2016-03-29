<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 10-3-2016
 * Time: 18:20
 */

namespace Zingular\Forms\Component;
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
     * @param $converter
     * @param $params
     * @return $this
     */
    public function setConverter($converter,...$params)
    {
        $this->converterConfig = new ConverterConfig($converter,$params);
        return $this;
    }

    /**
     * @return ConverterConfig
     */
    public function getConverter()
    {
        return $this->converterConfig;
    }
}