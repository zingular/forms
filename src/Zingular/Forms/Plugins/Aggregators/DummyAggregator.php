<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 2-2-2016
 * Time: 18:24
 */

namespace Zingular\Forms\Plugins\Aggregators;
use Zingular\Forms\Component\Containers\Aggregator;


/**
 * Class DummyAggregator
 * @package Zingular\Forms
 */
class DummyAggregator implements AggregatorInterface
{
    /**
     * @param array $values
     * @param Aggregator $aggregator
     * @return mixed
     */
    public function aggregate(array $values,Aggregator $aggregator)
    {
        return $values;
    }

    /**
     * @param mixed $value
     * @param Aggregator $aggregator
     * @return array
     */
    public function deaggegate($value,Aggregator $aggregator)
    {
        return $value;
    }
}