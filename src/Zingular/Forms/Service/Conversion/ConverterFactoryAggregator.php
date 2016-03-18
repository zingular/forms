<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 20:06
 */

namespace Zingular\Forms\Service\Conversion;
use Zingular\Forms\Exception\FormException;

use Zingular\Forms\Plugins\Converters\ConverterInterface;

/**
 * Class BuilderFactoryAggregator
 * @package Zingular\Form\Service\Builder
 */
class ConverterFactoryAggregator implements ConverterFactoryInterface
{
    /**
     * @var array
     */
    protected $factories = array();

    /**
     * @param ConverterFactoryInterface $factory
     */
    public function add(ConverterFactoryInterface $factory)
    {
        $this->factories = $factory;
    }

    /**
     * @param string $type
     * @return ConverterInterface
     * @throws FormException
     */
    public function create($type)
    {
        /** @var ConverterFactoryInterface $factory */
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

        throw new FormException(sprintf("Cannot create converter: none of the factories in the factory aggregator has the requested type '%s'!",$type));
    }
}