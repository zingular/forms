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
 * Class RuntimeBuilderAggregator
 * @package Zingular\Form\Service\Builder
 */
class RuntimeBuilderAggregator implements RuntimeBuilderInterface
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
     * @param FormState $context
     * @param array $options
     */
    public function build(BuildableInterface $container,FormState $context,array $options = array())
    {
        /** @var RuntimeBuilderInterface $builder */
        foreach($this->builders as $builder)
        {
            $builder->build($container,$context);
        }
    }
}