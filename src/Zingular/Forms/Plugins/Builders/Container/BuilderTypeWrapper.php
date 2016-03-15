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
class BuilderTypeWrapper extends AbstractBuilderType
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
     * @param BuildableInterface $container
     * @param FormState $context
     * @param array $options
     */
    public function build(BuildableInterface $container,FormState $context,array $options = array())
    {
        $this->builder->build($container,$context);
    }
}