<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 14-3-2016
 * Time: 18:16
 */

namespace Zingular\Forms\Extension;


/**
 * Interface FilterExtensionInterface
 * @package Zingular\Forms\Extension
 */
interface FilterExtensionInterface extends ExtensionInterface
{
    /**
     * @return array
     */
    public function getFilterTypes();
}