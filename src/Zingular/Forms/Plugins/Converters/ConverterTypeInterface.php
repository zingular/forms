<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 15-3-2016
 * Time: 22:24
 */

namespace Zingular\Forms\Plugins\Converters;



/**
 * Interface ConverterTypeInterface
 * @package Zingular\Forms\Plugins
 */
interface ConverterTypeInterface extends ConverterInterface
{
    /**
     * @return string
     */
    public function getName();
}