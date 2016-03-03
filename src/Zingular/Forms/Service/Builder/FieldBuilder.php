<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 12:32
 */

namespace Zingular\Forms\Service\Builder;

use Zingular\Forms\Component\Container\Container;
use Zingular\Forms\Component\Container\AbstractContainer;
use Zingular\Forms\Component\FormContext;

/**
 * Class FieldBuilder
 * @package Zingular\Form\Service\Builder
 */
class FieldBuilder implements RuntimeBuilderInterface
{
    /**
     * @param Container $container
     * @param FormContext $context
     */
    public function build(Container $container,FormContext $context)
    {
        $container->addLabel('lbl'.ucfirst($container->getId()),AbstractContainer::START)
            ->setFor($container)
            ->setTranslationKey($container->getId().'.label')
            ->compile($context);
    }
}