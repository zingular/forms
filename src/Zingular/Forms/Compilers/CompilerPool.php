<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 30-3-2016
 * Time: 17:47
 */

namespace Zingular\Forms\Compilers;

/**
 * Class CompilerPool
 * @package Zingular\Forms\Compilers
 */
class CompilerPool
{
    /**
     * @var CompilerFactory
     */
    protected $factory;

    /**
     * @var ControlCompiler
     */
    protected $controlCompiler;

    /**
     * @var ContainerCompiler
     */
    protected $containerCompiler;

    /**
     * @var ContentCompiler
     */
    protected $contentCompiler;

    /**
     * @var AggregatorCompiler
     */
    protected $aggregatorCompiler;

    /**
     * @param CompilerFactory $factory
     */
    public function __construct(CompilerFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @return ControlCompiler
     */
    public function getControlCompiler()
    {
        if(is_null($this->controlCompiler))
        {
            $this->controlCompiler = $this->factory->createControlCompiler();
        }
        return $this->controlCompiler;
    }

    /**
     * @return ContainerCompiler
     */
    public function getContainerCompiler()
    {
        if(is_null($this->containerCompiler))
        {
            $this->containerCompiler = $this->factory->createContainerCompiler();
        }
        return $this->containerCompiler;
    }

    /**
     * @return ContentCompiler
     */
    public function getContentCompiler()
    {
        if(is_null($this->contentCompiler))
        {
            $this->contentCompiler = $this->factory->createContentCompiler();
        }
        return $this->contentCompiler;
    }


    /**
     * @return AggregatorCompiler
     */
    public function getAggregatorCompiler()
    {
        if(is_null($this->aggregatorCompiler))
        {
            $this->aggregatorCompiler = $this->factory->createAggregatorCompiler($this->getContainerCompiler(),$this->getControlCompiler());
        }
        return $this->aggregatorCompiler;
    }
}