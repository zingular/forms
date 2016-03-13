<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 5-2-2016
 * Time: 21:56
 */

namespace Zingular\Forms\Plugins\Builders\Container;

use Zingular\Forms\Component\Containers\BuildableContainerInterface;
use Zingular\Forms\Component\Containers\BuildableInterface;
use Zingular\Forms\Component\FormState;


/**
 * Class TestBuilder
 * @package Zingular\Form\Service\Builder
 */
class TestBuilder implements RuntimeBuilderInterface
{
    /**
     * @param BuildableContainerInterface $container
     * @param FormState $context
     */
    public function build(BuildableContainerInterface $container,FormState $context)
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