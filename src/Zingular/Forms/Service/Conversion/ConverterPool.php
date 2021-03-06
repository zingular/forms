<?php

namespace Zingular\Forms\Service\Conversion;
use Zingular\Forms\Plugins\Converters\ConverterInterface;
use Zingular\Forms\Plugins\Converters\ConverterTypeInterface;

/**
 * Class ConverterPool
 * @package Zingular\Forms\Service\Conversion
 */
class ConverterPool
{
    /**
     * @var array
     */
    protected $converters = array();

    /**
     * @var ConverterFactoryInterface
     */
    protected $factory;

    /**
     * @param ConverterFactoryInterface $factory
     */
    public function __construct(ConverterFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param ConverterTypeInterface $converter
     */
    public function add(ConverterTypeInterface $converter)
    {
        $this->converters[$converter->getName()] = $converter;
    }

    /**
     * @param string $name
     * @return ConverterInterface
     */
    public function get($name)
    {
        if(isset($this->converters[$name]))
        {
            return $this->converters[$name];
        }
        else
        {
            $converter = $this->factory->create($name);
            $this->converters[$name] = $converter;
            return $converter;
        }
    }
}