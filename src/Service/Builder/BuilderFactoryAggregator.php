<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 20:06
 */

namespace Zingular\Form\Service\Builder;
use Zingular\Form\Exception\FormException;

/**
 * Class BuilderFactoryAggregator
 * @package Zingular\Form\Service\Builder
 */
class BuilderFactoryAggregator implements BuilderFactoryInterface
{
    /**
     * @var array
     */
    protected $factories = array();

    /**
     * @param string $type
     * @return BuilderInterface
     * @throws FormException
     */
    public function create($type)
    {
        /** @var BuilderFactoryInterface $factory */
        foreach($this->factories as $factory)
        {
            if($factory->has($type))
            {
                return $factory->create($type);
            }
        }

        throw new FormException(sprintf("Cannot create builder: none of the factories in the factory aggregator has the requested type '%s'!",$type));
    }

    /**
     * @param string $type
     * @return bool
     */
    public function has($type)
    {
        /** @var BuilderFactoryInterface $factory */
        foreach($this->factories as $factory)
        {
            if($factory->has($type))
            {
                return true;
            }
        }

        return false;
    }
}