<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 5-2-2016
 * Time: 21:56
 */

namespace Zingular\Form\Service\Builder;

use Zingular\Form\Component\Container\Container;


/**
 * Class TestBuilder
 * @package Zingular\Form\Service\Builder
 */
class TestBuilder implements BuilderInterface
{
    /**
     * @param Container $container
     */
    public function build(Container $container)
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