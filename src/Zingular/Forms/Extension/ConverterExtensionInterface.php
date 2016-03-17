<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 14-3-2016
 * Time: 18:20
 */

namespace Zingular\Forms\Extension;


/**
 * Interface ConverterExtensionInterface
 * @package Zingular\Forms\Extension
 */
interface ConverterExtensionInterface extends ExtensionInterface
{
    /**
     * @return array
     */
    public function getConverterTypes();
}