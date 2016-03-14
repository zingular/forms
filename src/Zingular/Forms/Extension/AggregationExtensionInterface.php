<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 14-3-2016
 * Time: 18:20
 */

namespace Zingular\Forms\Extension;


/**
 * Interface AggregationExtensionInterface
 * @package Zingular\Forms\Extension
 */
interface AggregationExtensionInterface extends ExtensionInterface
{
    /**
     * @return array
     */
    public function getAggregators();
}