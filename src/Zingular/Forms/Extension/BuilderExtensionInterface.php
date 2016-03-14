<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 14-3-2016
 * Time: 18:14
 */

namespace Zingular\Forms\Extension;


/**
 * Interface BuilderExtensionInterface
 * @package Zingular\Forms\Extension
 */
interface BuilderExtensionInterface extends ExtensionInterface
{
    /**
     * @return array
     */
    public function getBuilders();
}