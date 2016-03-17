<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 19:51
 */

namespace Zingular\Forms\Plugins\Builders\Container;

use Zingular\Forms\Component\Containers\BuildableInterface;
use Zingular\Forms\Component\FormState;


/**
 * Class BuilderTypeWrapper
 * @package Zingular\Form\Service\Builder
 */
class BuilderTypeWrapper implements BuilderTypeInterface
{
    /**
     * @var string
     */
    protected $name;

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
        $this->name = $name;
        $this->builder = $builder;
    }

    /**
     * @param BuildableInterface $container
     * @param FormState $context
     * @param array $options
     */
    public function build(BuildableInterface $container,FormState $context,array $options = array())
    {
        $this->builder->build($container,$context);
    }

    /**
     * @return string
     */
    public function getBuilderName()
    {
        return $this->name;
    }
}