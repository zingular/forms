<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 12:32
 */

namespace Zingular\Form\Service\Builder;

use Zingular\Form\Component\Container\Container;
use Zingular\Form\Component\Container\AbstractContainer;

/**
 * Class FieldBuilder
 * @package Zingular\Form\Service\Builder
 */
class FieldBuilder implements BuilderInterface
{
    /**
     * @param Container $container
     */
    public function build(Container $container)
    {
        $container->addLabel('lbl'.ucfirst($container->getId()),AbstractContainer::START)->setFor($container);
    }
}