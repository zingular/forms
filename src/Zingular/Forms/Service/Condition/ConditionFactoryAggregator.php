<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 20:06
 */

namespace Zingular\Forms\Service\Condition;
use Zingular\Forms\Exception\FormException;
use Zingular\Forms\Plugins\Builders\Container\BuilderInterface;
use Zingular\Forms\Plugins\Conditions\ConditionInterface;

/**
 * Class BuilderFactoryAggregator
 * @package Zingular\Form\Service\Builder
 */
class ConditionFactoryAggregator implements ConditionFactoryInterface
{
    /**
     * @var array
     */
    protected $factories = array();

    /**
     * @param ConditionFactoryInterface $factory
     */
    public function add(ConditionFactoryInterface $factory)
    {
        $this->factories = $factory;
    }

    /**
     * @param string $type
     * @return ConditionInterface
     * @throws FormException
     */
    public function create($type)
    {
        /** @var ConditionFactoryInterface $factory */
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

        throw new FormException(sprintf("Cannot create condition: none of the factories in the factory aggregator has the requested type '%s'!",$type));
    }
}