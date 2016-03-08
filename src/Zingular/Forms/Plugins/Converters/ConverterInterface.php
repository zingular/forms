<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 2-2-2016
 * Time: 21:29
 */

namespace Zingular\Forms\Plugins\Converters;

/**
 * Interface ConverterInterface
 * @package Zingular\Form
 */
interface ConverterInterface
{
    /**
     * @param $value
     * @param array ...$params
     * @return mixed
     */
    public function encode($value,...$params);

    /**
     * @param $value
     * @param $params
     * @return mixed
     */
    public function decode($value,...$params);

    /**
     * @return string
     */
    public function getName();
}