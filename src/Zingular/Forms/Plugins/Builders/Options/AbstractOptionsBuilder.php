<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 11-2-2016
 * Time: 18:21
 */

namespace Zingular\Forms\Plugins\Builders\Options;

use Zingular\Forms\Component\Containers\BuildableInterface;
use Zingular\Forms\Component\FormState;

/**
 * Class AbstractOptionsBuilder
 * @package Zingular\Form\Service\Builder
 */
abstract class AbstractOptionsBuilder implements OptionsBuilderInterface
{
    /**
     * @param BuildableInterface $container
     * @param FormState $state
     * @param OptionsProvider $provider
     */
    public function buildOptions(BuildableInterface $container,FormState $state,OptionsProvider $provider)
    {
        $this->buildGroup($provider->getOptions(),$container,$state);
    }

    /**
     * @param array $options
     * @param BuildableInterface $container
     * @param FormState $state
     */
    protected function buildGroup(array $options,BuildableInterface $container,FormState $state)
    {
        foreach($options as $key=>$value)
        {
            // option group
            if(is_array($value))
            {
                $this->buildGroup($value,$this->addGroup($key,$container,$state),$state);
            }
            // regular option
            else
            {
                $this->addOption($container,$key,$value,$state);
            }
        }
    }

    /**
     * @param $groupName
     * @param BuildableInterface $container
     * @param FormState $state
     * @return BuildableInterface
     */
    abstract protected function addGroup($groupName,BuildableInterface $container,FormState $state);

    /**
     * @param BuildableInterface $container
     * @param $key
     * @param $value
     * @param FormState $state
     * @return
     */
    abstract protected function addOption(BuildableInterface $container,$key,$value,FormState $state);
}