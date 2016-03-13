<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 19:51
 */

namespace Zingular\Forms\Plugins\Builders\Container;

use Zingular\Forms\Component\Containers\BuildableContainerInterface;
use Zingular\Forms\Component\Containers\BuildableInterface;

use Zingular\Forms\Component\FormState;


/**
 * Class RegisterableBuilderWrapper
 * @package Zingular\Form\Service\Builder
 */
class RegisterableBuilderWrapper extends AbstractRegisterableBuilder
{
    /**
     * @var RuntimeBuilderInterface
     */
    protected $builder;

    /**
     * @param $name
     * @param RuntimeBuilderInterface $builder
     */
    public function __construct($name,RuntimeBuilderInterface $builder)
    {
        parent::__construct($name);
        $this->builder = $builder;
    }


    /**
     * @param BuildableContainerInterface $container
     * @param FormState $context
     */
    public function build(BuildableContainerInterface $container,FormState $context)
    {
        $this->builder->build($container,$context);
    }
}