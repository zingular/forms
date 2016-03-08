<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 5-2-2016
 * Time: 21:56
 */

namespace Zingular\Forms\Service\Builder;

use Zingular\Forms\Component\Container\BuildableInterface;
use Zingular\Forms\Component\FormContext;

/**
 * Class TestBuilder
 * @package Zingular\Form\Service\Builder
 */
class TestBuilder implements RuntimeBuilderInterface
{
    /**
     * @param BuildableInterface $container
     * @param FormContext $context
     */
    public function build(BuildableInterface $container,FormContext $context)
    {
        $container->addInput('lalala');
        $container->addInput('lalala');
        $container->addInput('lalala');
        $container->addInput('lalala');
        $container->addInput('lalala');
        $container->addInput('lalala');
        $container->addInput('lalala');
        $container->addInput('lalala');
        $container->addInput('lalala');
    }
}