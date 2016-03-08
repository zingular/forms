<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 20:26
 */

namespace Zingular\Forms\Service\Aggregation;
use Zingular\Forms\Plugins\Aggregators\AggregatorInterface;
use Zingular\Forms\Plugins\Aggregators\PoolableAggregatorInterface;

/**
 * Class AggregatorPool
 * @package Zingular\Form\Service\Aggregation
 */
class AggregatorPool
{
    /**
     * @var array
     */
    protected $pool = array();

    /**
     * @var AggregatorFactoryInterface
     */
    protected $factory;

    /**
     * @param AggregatorFactoryInterface $factory
     */
    public function __construct(AggregatorFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param PoolableAggregatorInterface $aggregator
     */
    public function add(PoolableAggregatorInterface $aggregator)
    {
        $this->pool[$aggregator->getAggregatorName()] = $aggregator;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has($name)
    {
        return isset($this->pool[$name]);
    }

    /**
     * @param string $name
     * @return AggregatorInterface
     */
    public function get($name)
    {
        if($this->has($name))
        {
            return $this->pool[$name];
        }

        $aggregator = $this->factory->create($name);

        $this->pool[$name] = $aggregator;

        return $aggregator;
    }
}