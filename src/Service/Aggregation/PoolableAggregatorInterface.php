<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 20:22
 */

namespace Zingular\Form\Service\Aggregation;

/**
 * Interface PoolableAggregatorInterface
 * @package Zingular\Form\Service\Aggregation
 */
interface PoolableAggregatorInterface extends AggregatorInterface
{
    /**
     * @return string
     */
    public function getAggregatorName();
}