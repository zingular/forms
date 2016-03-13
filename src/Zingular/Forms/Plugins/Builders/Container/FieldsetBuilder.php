<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 11:28
 */

namespace Zingular\Forms\Plugins\Builders\Container;

use Zingular\Forms\Component\Containers\BuildableContainerInterface;
use Zingular\Forms\Component\Containers\BuildableInterface;

use Zingular\Forms\Component\FormState;


/**
 * Class FieldsetBuilder
 * @package Service\Builder
 */
class FieldsetBuilder implements RuntimeBuilderInterface
{
    /**
     * @param BuildableContainerInterface $container
     * @param FormState $context
     */
    public function build(BuildableContainerInterface $container,FormState $context)
    {
        // create a legend first
        $container->addHtmlTag('p'.ucfirst($container->getId()),self::POSITION_START)
            ->setTagName('p')
            ->setTranslationKey($container->getId().'.description');
        $container->addHtmlTag('lgnd'.ucfirst($container->getId()),self::POSITION_START)
            ->setTagName('legend')
            ->setTranslationKey($container->getId().'.legend');
    }
}