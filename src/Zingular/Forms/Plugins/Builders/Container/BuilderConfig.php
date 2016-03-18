<?php
/**
 * Created by PhpStorm.
 * User: michielleideman
 * Date: 14-03-16
 * Time: 13:41
 */

namespace Zingular\Forms\Plugins\Builders\Container;

/**
 * Class BuilderConfig
 * @package Zingular\Forms\Plugins\Builders\Container
 */
class BuilderConfig
{
    /**
     * @var string|SimpleBuilderInterface|BuilderInterface|callable
     */
    protected $builder;

    /**
     * @var array
     */
    protected $options;

    /**
     * BuilderConfig constructor.
     * @param callable|string|BuilderInterface|SimpleBuilderInterface $builder
     * @param array $options
     */
    public function __construct($builder,array $options = array())
    {
        $this->builder = $builder;
        $this->options = $options;
    }

    /**
     * @return array
     */
    public function getBuilderType()
    {
        return $this->builder;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }
}