<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 11-2-2016
 * Time: 18:21
 */

namespace Zingular\Forms\Plugins\Builders\Options;

use Zingular\Forms\Component\Containers\BuildableContainerInterface;
use Zingular\Forms\Component\Containers\BuildableInterface;
use Zingular\Forms\Component\FormState;
use Zingular\Forms\Component\OptionsProvider;
use Zingular\Forms\Plugins\Builders\Container\RuntimeBuilderInterface;

/**
 * Class AbstractOptionsBuilder
 * @package Zingular\Form\Service\Builder
 */
abstract class AbstractOptionsBuilder extends OptionsProvider implements RuntimeBuilderInterface
{
    /**
     * @param BuildableContainerInterface $container
     * @param FormState $context
     */
    public function build(BuildableContainerInterface $container,FormState $context)
    {
        $this->buildGroup($this->getOptions(),$container);
    }

    /**
     * @param array $options
     * @param BuildableInterface $container
     */
    protected function buildGroup(array $options,BuildableInterface $container)
    {
        foreach($options as $key=>$value)
        {
            // option group
            if(is_array($value))
            {
                $this->buildGroup($value,$this->addGroup($key,$container));
            }
            // regular option
            else
            {
                $this->addOption($container,$key,$value);
            }
        }
    }

    /**
     * @param $groupName
     * @param BuildableInterface $container
     * @return BuildableInterface
     */
    abstract protected function addGroup($groupName,BuildableInterface $container);

    /**
     * @param BuildableInterface $container
     * @param $key
     * @param $value
     */
    abstract protected function addOption(BuildableInterface $container,$key,$value);

}