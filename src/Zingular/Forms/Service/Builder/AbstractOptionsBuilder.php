<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 11-2-2016
 * Time: 18:21
 */

namespace Zingular\Forms\Service\Builder;

use Zingular\Forms\Component\Container\BuildableInterface;
use Zingular\Forms\Component\FormContext;
use Zingular\Forms\Component\OptionsProvider;

/**
 * Class AbstractOptionsBuilder
 * @package Zingular\Form\Service\Builder
 */
abstract class AbstractOptionsBuilder extends OptionsProvider implements RuntimeBuilderInterface
{
    /**
     * @param BuildableInterface $container
     * @param FormContext $context
     */
    public function build(BuildableInterface $container,FormContext $context)
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