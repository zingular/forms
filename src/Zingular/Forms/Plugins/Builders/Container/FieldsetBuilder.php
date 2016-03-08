<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 11:28
 */

namespace Zingular\Forms\Plugins\Builders\Container;

use Zingular\Forms\Component\Container\BuildableInterface;
use Zingular\Forms\Component\Container\Container;
use Zingular\Forms\Component\FormContext;


/**
 * Class FieldsetBuilder
 * @package Service\Builder
 */
class FieldsetBuilder implements RuntimeBuilderInterface
{
    /**
     * @param BuildableInterface $container
     * @param FormContext $context
     */
    public function build(BuildableInterface $container,FormContext $context)
    {
        // create a legend first
        $container->addHtmlTag('p'.ucfirst($container->getId()),Container::START)
            ->setTagName('p')
            ->setTranslationKey($container->getId().'.description');
        $container->addHtmlTag('lgnd'.ucfirst($container->getId()),Container::START)
            ->setTagName('legend')
            ->setTranslationKey($container->getId().'.legend');
    }
}