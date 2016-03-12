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
     * @param mixed $value
     * @param array $params
     * @return mixed
     */
    public function encode($value,array $params = array());

    /**
     * @param mixed $value
     * @param array $params
     * @return mixed
     */
    public function decode($value,array $params = array());

    /**
     * @return string
     */
    public function getName();
}