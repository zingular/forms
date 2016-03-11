<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 2-2-2016
 * Time: 19:41
 */

namespace Zingular\Forms\Plugins\Builders\Container;
use Zingular\Forms\Component\Container\BuildableInterface;
use Zingular\Forms\Component\FormState;
use Zingular\Forms\Plugins\Builders\Container\RuntimeBuilderInterface;

/**
 * Class DateTimeContainerStrategy
 * @package Zingular\Form
 */
class DateTimeSelectBuilder implements RuntimeBuilderInterface
{
    /**
     * @param BuildableInterface $container
     * @param FormState $context
     */
    public function build(BuildableInterface $container,FormState $context)
    {
        $container->addInput('n');
        $container->addInput('j');
        $container->addInput('Y');
    }
}