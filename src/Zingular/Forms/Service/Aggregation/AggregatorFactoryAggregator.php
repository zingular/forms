<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 20:06
 */

namespace Zingular\Forms\Service\Aggregation;
use Zingular\Forms\Exception\FormException;
use Zingular\Forms\Plugins\Aggregators\AggregatorInterface;
use Zingular\Forms\Plugins\Builders\Container\BuilderInterface;

/**
 * Class BuilderFactoryAggregator
 * @package Zingular\Form\Service\Builder
 */
class AggregatorFactoryAggregator implements AggregatorFactoryInterface
{
    /**
     * @var array
     */
    protected $factories = array();

    /**
     * @param AggregatorFactoryInterface $factory
     */
    public function add(AggregatorFactoryInterface $factory)
    {
        $this->factories = $factory;
    }

    /**
     * @param string $type
     * @return AggregatorInterface
     * @throws FormException
     */
    public function create($type)
    {
        /** @var AggregatorFactoryInterface $factory */
        foreach($this->factories as $factory)
        {
            try
            {
                return $factory->create($type);
            }
            catch(FormException $e)
            {
                continue;
            }
        }

        throw new FormException(sprintf("Cannot create aggregator: none of the factories in the factory aggregator has the requested type '%s'!",$type));
    }
}