<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 20:06
 */

namespace Zingular\Forms\Service\Evaluation;
use Zingular\Forms\Exception\FormException;

use Zingular\Forms\Plugins\Evaluators\FilterInterface;

/**
 * Class BuilderFactoryAggregator
 * @package Zingular\Form\Service\Builder
 */
class FilterFactoryAggregator implements FilterFactoryInterface
{
    /**
     * @var array
     */
    protected $factories = array();

    /**
     * @param FilterFactoryInterface $factory
     */
    public function add(FilterFactoryInterface $factory)
    {
        $this->factories = $factory;
    }

    /**
     * @param string $type
     * @return FilterInterface
     * @throws FormException
     */
    public function create($type)
    {
        /** @var FilterFactoryInterface $factory */
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

        throw new FormException(sprintf("Cannot create filter: none of the factories in the factory aggregator has the requested type '%s'!",$type));
    }
}