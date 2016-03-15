<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 2-2-2016
 * Time: 19:41
 */

namespace Zingular\Forms\Plugins\Builders\Container;
use Zingular\Forms\Component\Containers\BuildableInterface;
use Zingular\Forms\Component\FormState;


/**
 * Class DateTimeContainerStrategy
 * @package Zingular\Form
 */
class DateTimeSelectBuilder implements BuilderInterface
{
    /**
     * @param BuildableInterface $container
     * @param FormState $context
     * @param array $options
     */
    public function build(BuildableInterface $container,FormState $context,array $options = array())
    {
        $container->addInput('n');
        $container->addInput('j');
        $container->addInput('Y');
    }
}