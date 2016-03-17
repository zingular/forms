<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 14-3-2016
 * Time: 18:17
 */

namespace Zingular\Forms\Extension;


/**
 * Interface ConditionExtensionInterface
 * @package Zingular\Forms\Extension
 */
interface ConditionExtensionInterface extends ExtensionInterface
{
    /**
     * @return array
     */
    public function getConditionTypes();
}