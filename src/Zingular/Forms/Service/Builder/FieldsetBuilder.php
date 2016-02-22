<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 11:28
 */

namespace Zingular\Forms\Service\Builder;

use Zingular\Forms\Component\Container\Container;


/**
 * Class FieldsetBuilder
 * @package Service\Builder
 */
class FieldsetBuilder implements BuilderInterface
{
    /**
     * @param Container $container
     */
    public function build(Container $container)
    {
        // create a legend first
        $container->addHtmlTag('p'.ucfirst($container->getId()),Container::START)->setTagName('p');
        $container->addHtmlTag('lgnd'.ucfirst($container->getId()),Container::START)->setTagName('legend');
    }
}