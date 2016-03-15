<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 15-3-2016
 * Time: 21:14
 */

namespace Zingular\Forms\Plugins\Conditions;

use Zingular\Forms\Component\ComponentInterface;
use Zingular\Forms\Component\FormState;
use Zingular\Forms\Condition;

/**
 * Class ComponentPropertyCondition
 * @package Zingular\Forms\Plugins\Conditions
 */
class ComponentPropertyCondition extends CallableCondition
{
    /**
     *
     */
    public function __construct()
    {
        parent::__construct(Condition::COMPONENT_PROPERTY,array($this,'validate'),$contextAware = true);
    }

    /**
     * @param ComponentInterface $source
     * @param FormState $state
     * @param $target
     * @param $property
     * @throws \Exception
     */
    public function validate(ComponentInterface $source, FormState $state,$target,$property)
    {
        $target = $state->getComponentByName($target);

        

        //echo $target->getFullId();
    }
}