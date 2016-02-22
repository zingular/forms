<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 2-2-2016
 * Time: 19:41
 */

namespace Zingular\Forms\Service\Builder;
use Zingular\Forms\Component\Container\Container;

/**
 * Class DateTimeContainerStrategy
 * @package Zingular\Form
 */
class DateTimeSelectBuilder implements BuilderInterface
{
    /**
     * @param Container $container
     */
    public function build(Container $container)
    {
        $container->addInput('n');
        $container->addInput('j');
        $container->addInput('Y');
    }
}