<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 29-3-2016
 * Time: 20:40
 */

namespace Zingular\Forms\Component;

use Zingular\Forms\Service\Conversion\ConverterConfig;

/**
 * Interface ConvertableInterface
 * @package Zingular\Forms\Component
 */
interface ConvertableInterface
{
    /**
     * @param string $converter
     * @param $params
     * @return $this
     */
    public function setConverter($converter,...$params);

    /**
     * @return ConverterConfig
     */
    public function getConverter();
}