<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 17-3-2016
 * Time: 19:24
 */

namespace Zingular\Forms\Plugins\Aggregators;

use Zingular\Forms\Component\Containers\Aggregator;

/**
 * Class CallableAggregatorType
 * @package Zingular\Forms\Plugins\Aggregators
 */
class CallableAggregatorType implements AggregatorTypeInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var callable
     */
    protected $aggregateCallback;

    /**
     * @var callable
     */
    protected $deaggregateCallback;

    /**
     * @param $name
     * @param $aggregateCallback
     * @param $deaggregateCallback
     */
    public function __construct($name,$aggregateCallback,$deaggregateCallback)
    {
        $this->name = $name;
        $this->aggregateCallback = $aggregateCallback;
        $this->deaggregateCallback = $deaggregateCallback;
    }

    /**
     * @param array $values
     * @param Aggregator $aggregator
     * @param array $options
     * @return mixed
     */
    public function aggregate(array $values, Aggregator $aggregator, array $options = array())
    {
        array_unshift($options,$values,$aggregator);
        return call_user_func_array($this->aggregateCallback,$options);
    }

    /**
     * @param $value
     * @param Aggregator $aggregator
     * @param array $options
     * @return array
     */
    public function deaggegate($value, Aggregator $aggregator, array $options = array())
    {
        array_unshift($options,$values,$aggregator);
        return call_user_func_array($this->deaggregateCallback,$options);
    }

    /**
     * @return string
     */
    public function getAggregatorName()
    {
        return $this->name;
    }
}