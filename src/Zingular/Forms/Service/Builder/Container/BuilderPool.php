<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 19:36
 */

namespace Zingular\Forms\Service\Builder\Container;
use Zingular\Forms\Plugins\Builders\Container\RegisterableBuilderInterface;
use Zingular\Forms\Plugins\Builders\Container\RuntimeBuilderInterface;
use Zingular\Forms\Service\Builder\Container\BuilderFactoryInterface;

/**
 * Class BuilderPool
 * @package Zingular\Form\Service\Builder
 */
class BuilderPool
{
    /**
     * @var array
     */
    protected $pool = array();

    /**
     * @var BuilderFactoryInterface
     */
    protected $factory;

    /**
     * @param BuilderFactoryInterface $factory
     */
    public function __construct(BuilderFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param RegisterableBuilderInterface $builder
     */
    public function add(RegisterableBuilderInterface $builder)
    {
        $this->pool[$builder->getBuilderName()] = $builder;
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
     * @return RuntimeBuilderInterface
     */
    public function get($name)
    {
        if($this->has($name))
        {
            return $this->pool[$name];
        }

        $builder = $this->factory->create($name);

        $this->pool[$name] = $builder;

        return $builder;
    }
}