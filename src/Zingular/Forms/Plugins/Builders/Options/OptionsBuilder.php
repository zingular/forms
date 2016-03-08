<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 5-2-2016
 * Time: 22:20
 */

namespace Zingular\Forms\Plugins\Builders\Options;

use Zingular\Forms\Component\Container\BuildableInterface;
use Zingular\Forms\Component\Container\Container;

use Zingular\Forms\Plugins\Builders\Container\RuntimeBuilderInterface;

/**
 * Class OptionsBuilder
 * @package Zingular\Form\Service\Builder
 */
class OptionsBuilder extends AbstractOptionsBuilder implements RuntimeBuilderInterface
{
    /**
     * @param $groupName
     * @param BuildableInterface $container
     * @return Container
     */
    protected function addGroup($groupName,BuildableInterface $container)
    {
        return $container->addContainer($groupName);
    }

    /**
     * @param BuildableInterface $container
     * @param $key
     * @param $value
     */
    protected function addOption(BuildableInterface $container,$key,$value)
    {
        $label = $container->addLabel('lbl'.ucfirst($key));
        $checkbox = $container->addCheckbox($key);
        $label->setFor($checkbox);
    }
}