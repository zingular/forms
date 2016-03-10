<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 12:32
 */

namespace Zingular\Forms\Plugins\Builders\Container;

use Zingular\Forms\Component\Container\BuildableInterface;
use Zingular\Forms\Component\Container\AbstractContainer;
use Zingular\Forms\Component\State;


/**
 * Class FieldBuilder
 * @package Zingular\Form\Service\Builder
 */
class FieldBuilder implements RuntimeBuilderInterface
{
    /**
     * @param BuildableInterface $container
     * @param State $context
     */
    public function build(BuildableInterface $container,State $context)
    {
        $container->addLabel('lbl'.ucfirst($container->getId()),AbstractContainer::START)
            ->setFor($container)
            ->setTranslationKey($container->getId().'.label');
    }
}