<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 2-2-2016
 * Time: 21:29
 */

namespace Zingular\Forms\Service\Conversion;

/**
 * Interface ConverterStrategyInterface
 * @package Zingular\Form
 */
interface ConverterStrategyInterface
{
    /**
     * @param $value
     * @return mixed
     */
    public function logicalToData($value);

    /**
     * @param $value
     * @return mixed
     */
    public function dataToLogical($value);
}