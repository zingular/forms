<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 5-2-2016
 * Time: 22:20
 */

namespace Zingular\Forms\Plugins\Builders\Options;

use Zingular\Forms\Component\Containers\BuildableInterface;
use Zingular\Forms\Component\Containers\Container;
use Zingular\Forms\Component\FormState;

/**
 * Class OptionsBuilder
 * @package Zingular\Form\Service\Builder
 */
class OptionsBuilder extends AbstractOptionsBuilder
{
    /**
     * @param $groupName
     * @param BuildableInterface $container
     * @param FormState $state
     * @return Container
     */
    protected function addGroup($groupName,BuildableInterface $container,FormState $state)
    {
        return $container->addContainer($groupName);
    }

    /**
     * @param BuildableInterface $container
     * @param $key
     * @param $value
     * @param FormState $state
     */
    protected function addOption(BuildableInterface $container,$key,$value,FormState $state)
    {
        $label = $container->addLabel('lbl'.ucfirst($key));
        $checkbox = $container->addCheckbox($key);
        $label->setFor($checkbox);
    }
}