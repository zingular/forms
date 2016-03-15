<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 20:06
 */

namespace Zingular\Forms\Service\Builder\Container;
use Zingular\Forms\Exception\FormException;
use Zingular\Forms\Plugins\Builders\Container\BuilderInterface;

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
            try
            {
                return $factory->create($type);
            }
            catch(FormException $e)
            {
                continue;
            }
        }

        throw new FormException(sprintf("Cannot create builder: none of the factories in the factory aggregator has the requested type '%s'!",$type));
    }
}