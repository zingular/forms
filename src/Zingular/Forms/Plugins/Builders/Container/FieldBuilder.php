<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 12:32
 */

namespace Zingular\Forms\Plugins\Builders\Container;

use Zingular\Forms\Component\Containers\BuildableInterface;
use Zingular\Forms\Component\FormState;


/**
 * Class FieldBuilder
 * @package Zingular\Form\Service\Builder
 */
class FieldBuilder implements RuntimeBuilderInterface
{
    /**
     * @param BuildableInterface $container
     * @param FormState $context
     */
    public function build(BuildableInterface $container,FormState $context)
    {
        $container->addLabel('lbl'.ucfirst($container->getId()),self::POSITION_START)
            ->setFor($container)
            ->setTranslationKey($container->getId().'.label');
    }
}