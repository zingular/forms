<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 5-2-2016
 * Time: 22:20
 */

namespace Zingular\Forms\Service\Builder;

use Zingular\Forms\Component\Container\Container;

/**
 * Class OptionsBuilder
 * @package Zingular\Form\Service\Builder
 */
class OptionsBuilder extends AbstractOptionsBuilder implements RuntimeBuilderInterface
{
    /**
     * @param $groupName
     * @param Container $container
     * @return Container
     */
    protected function addGroup($groupName,Container $container)
    {
        return $container->addContainer($groupName);
    }

    /**
     * @param Container $container
     * @param $key
     * @param $value
     */
    protected function addOption(Container $container,$key,$value)
    {
        $label = $container->addLabel('lbl'.ucfirst($key));
        $checkbox = $container->addCheckbox($key);
        $label->setFor($checkbox);
    }
}