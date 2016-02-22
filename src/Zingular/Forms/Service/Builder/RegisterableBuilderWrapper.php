<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 19:51
 */

namespace Zingular\Forms\Service\Builder;

use Zingular\Forms\Component\Container\Container;

/**
 * Class RegisterableBuilderWrapper
 * @package Zingular\Form\Service\Builder
 */
class RegisterableBuilderWrapper extends AbstractRegisterableBuilder
{
    /**
     * @var BuilderInterface
     */
    protected $builder;

    /**
     * @param $name
     * @param BuilderInterface $builder
     */
    public function __construct($name,BuilderInterface $builder)
    {
        parent::__construct($name);
        $this->builder = $builder;
    }


    /**
     * @param Container $container
     */
    public function build(Container $container)
    {
        $this->builder->build($container);
    }
}