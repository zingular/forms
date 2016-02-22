<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 14-2-2016
 * Time: 13:25
 */

namespace Zingular\Form\Service\Builder;


use Zingular\Form\Component\Container\Container;

/**
 * Class BuilderAggregator
 * @package Zingular\Form\Service\Builder
 */
class BuilderAggregator implements BuilderInterface
{
    /**
     * @var array
     */
    protected $builders = array();

    /**
     * @param BuilderInterface $builder
     * @return $this
     */
    public function addBuilder(BuilderInterface $builder)
    {
        $this->builders[] = $builder;
        return $this;
    }

    /**
     * @param Container $container
     */
    public function build(Container $container)
    {
        /** @var BuilderInterface $builder */
        foreach($this->builders as $builder)
        {
            $builder->build($container);
        }
    }
}