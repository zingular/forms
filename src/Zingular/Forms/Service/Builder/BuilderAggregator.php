<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 14-2-2016
 * Time: 13:25
 */

namespace Zingular\Forms\Service\Builder;


use Zingular\Forms\Component\Container\BuildableInterface;
use Zingular\Forms\Component\Container\Container;
use Zingular\Forms\Component\FormContext;

/**
 * Class BuilderAggregator
 * @package Zingular\Form\Service\Builder
 */
class BuilderAggregator implements RuntimeBuilderInterface
{
    /**
     * @var array
     */
    protected $builders = array();

    /**
     * @param RuntimeBuilderInterface $builder
     * @return $this
     */
    public function addBuilder(RuntimeBuilderInterface $builder)
    {
        $this->builders[] = $builder;
        return $this;
    }

    /**
     * @param BuildableInterface $container
     * @param FormContext $context
     */
    public function build(BuildableInterface $container,FormContext $context)
    {
        /** @var RuntimeBuilderInterface $builder */
        foreach($this->builders as $builder)
        {
            $builder->build($container,$context);
        }
    }
}