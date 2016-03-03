<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 19:51
 */

namespace Zingular\Forms\Service\Builder;

use Zingular\Forms\Component\Container\Container;
use Zingular\Forms\Component\FormContext;

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
     * @param Container $container
     * @param FormContext $context
     */
    public function build(Container $container,FormContext $context)
    {
        $this->builder->build($container,$context);
    }
}