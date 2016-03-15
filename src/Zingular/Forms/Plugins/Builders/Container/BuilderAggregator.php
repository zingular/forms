<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 14-2-2016
 * Time: 13:25
 */

namespace Zingular\Forms\Plugins\Builders\Container;

use Zingular\Forms\Component\Containers\BuildableInterface;
use Zingular\Forms\Component\FormState;


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
     * @param SimpleBuilderInterface $builder
     * @return $this
     */
    public function addSimpleBuilder(SimpleBuilderInterface $builder)
    {
        $this->builders[] = $builder;
        return $this;
    }

    /**
     * @param BuildableInterface $container
     * @param FormState $context
     * @param array $options
     */
    public function build(BuildableInterface $container,FormState $context,array $options = array())
    {
        foreach($this->builders as $builder)
        {
            if($builder instanceof BuilderInterface)
            {
                $builder->build($container,$context,$options);
            }
            elseif($builder instanceof SimpleBuilderInterface)
            {
                $builder->build($container,$options);
            }
        }
    }
}