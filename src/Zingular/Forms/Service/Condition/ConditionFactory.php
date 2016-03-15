<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 10:59
 */

namespace Zingular\Forms\Service\Condition;
use Zingular\Forms\Component\ComponentInterface;
use Zingular\Forms\Condition;
use Zingular\Forms\Exception\FormException;

use Zingular\Forms\Plugins\Conditions\CallableCondition;
use Zingular\Forms\Plugins\Conditions\ComponentPropertyCondition;
use Zingular\Forms\Plugins\Conditions\ConditionInterface;
use Zingular\Forms\Plugins\Conditions\FieldValueCondition;

/**
 * Class ConditionFactory
 * @package Zingular\Form\Service\ConditionGroup
 */
class ConditionFactory implements ConditionFactoryInterface
{
    /**
     * @param $type
     * @param array $options
     * @return ConditionInterface
     * @throws FormException
     */
    public function create($type,array $options = array())
    {
        switch($type)
        {
            case Condition::VALUE: return new CallableCondition(Condition::VALUE,function(ComponentInterface $component,$value){return (bool) $value;});
            case Condition::TRUE: return new CallableCondition(Condition::TRUE,function(){return true;});
            case Condition::FALSE: return new CallableCondition(Condition::FALSE,function(){return false;});
            case Condition::FIELD_VALUE: return new FieldValueCondition();
            case Condition::CALLBACK: return new CallbackCondition();
            case Condition::COMPONENT_PROPERTY: return new ComponentPropertyCondition();
        }

        throw new FormException(sprintf("Cannot create condition: unknown condition type '%s'",$type));
    }
}