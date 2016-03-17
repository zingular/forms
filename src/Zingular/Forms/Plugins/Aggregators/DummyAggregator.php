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
     * @param array $options
     * @return mixed
     */
    public function aggregate(array $values,Aggregator $aggregator,array $options = array())
    {
        return $values;
    }

    /**
     * @param mixed $value
     * @param Aggregator $aggregator
     * @param array $options
     * @return array
     */
    public function deaggegate($value,Aggregator $aggregator,array $options = array())
    {
        return $value;
    }
}