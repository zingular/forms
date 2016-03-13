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
 * Class RuntimeBuilderAdapter
 * @package Zingular\Forms\Plugins\Builders\Container
 */
class RuntimeBuilderAdapter implements RuntimeBuilderInterface
{
    /**
     * @var BuilderInterface
     */
    protected $builder;

    /**
     * RuntimeBuilderAdapter constructor.
     * @param BuilderInterface $builder
     */
    public function __construct(BuilderInterface $builder)
    {
        $this->builder = $builder;
    }

    /**
     * @param BuildableInterface $container
     * @param FormState $context
     */
    public function build(BuildableInterface $container, FormState $context)
    {
        $this->builder->build($container);
    }
}