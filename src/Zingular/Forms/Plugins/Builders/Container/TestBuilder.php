<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 5-2-2016
 * Time: 21:56
 */

namespace Zingular\Forms\Plugins\Builders\Container;

use Zingular\Forms\Component\Container\BuildableInterface;
use Zingular\Forms\Component\State;


/**
 * Class TestBuilder
 * @package Zingular\Form\Service\Builder
 */
class TestBuilder implements RuntimeBuilderInterface
{
    /**
     * @param BuildableInterface $container
     * @param State $context
     */
    public function build(BuildableInterface $container,State $context)
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