<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 11:28
 */

namespace Zingular\Forms\Service\Builder;

use Zingular\Forms\Component\Container\Container;
use Zingular\Forms\Component\FormContext;


/**
 * Class FieldsetBuilder
 * @package Service\Builder
 */
class FieldsetBuilder implements RuntimeBuilderInterface
{
    /**
     * @param Container $container
     * @param FormContext $context
     */
    public function build(Container $container,FormContext $context)
    {
        // create a legend first
        $container->addHtmlTag('p'.ucfirst($container->getId()),Container::START)
            ->setTagName('p')
            ->setTranslationKey($container->getId().'.description')
            ->compile($context);
        $container->addHtmlTag('lgnd'.ucfirst($container->getId()),Container::START)
            ->setTagName('legend')
            ->setTranslationKey($container->getId().'.legend')
            ->compile($context);
    }
}