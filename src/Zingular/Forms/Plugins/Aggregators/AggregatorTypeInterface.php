<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 20:22
 */

namespace Zingular\Forms\Plugins\Aggregators;


/**
 * Interface AggregatorTypeInterface
 * @package Zingular\Form\Service\Aggregation
 */
interface AggregatorTypeInterface extends AggregatorInterface
{
    /**
     * @return string
     */
    public function getAggregatorName();
}