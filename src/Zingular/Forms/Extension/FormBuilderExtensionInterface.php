<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 14-3-2016
 * Time: 18:15
 */

namespace Zingular\Forms\Extension;

/**
 * Interface FormBuilderExtensionInterface
 * @package Zingular\Forms\Extension
 */
interface FormBuilderExtensionInterface extends ExtensionInterface
{
    /**
     * @return array
     */
    public function getFormBuilders();
}