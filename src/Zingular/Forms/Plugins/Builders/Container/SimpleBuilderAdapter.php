<?php
/**
 * Created by PhpStorm.
 * User: michielleideman
 * Date: 09-03-16
 * Time: 08:58
 */

namespace Zingular\Forms\Plugins\Builders\Container;

use Zingular\Forms\Component\Containers\BuildableInterface;
use Zingular\Forms\Component\FormState;

/**
 * Class SimpleBuilderAdapter
 * @package Zingular\Forms\Plugins\Builders\Container
 */
class SimpleBuilderAdapter implements BuilderInterface
{
    /**
     * @var SimpleBuilderInterface
     */
    protected $builder;

    /**
     * SimpleBuilderAdapter constructor.
     * @param SimpleBuilderInterface $builder
     */
    public function __construct(SimpleBuilderInterface $builder)
    {
        $this->builder = $builder;
    }

    /**
     * @param BuildableInterface $container
     * @param FormState $context
     * @param array $options
     */
    public function build(BuildableInterface $container, FormState $context,array $options = array())
    {
        $this->builder->build($container);
    }
}