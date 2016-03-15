<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 11-3-2016
 * Time: 22:11
 */

namespace Zingular\Forms\Service\Condition;


use Zingular\Forms\Component\ComponentInterface;
use Zingular\Forms\Component\FormState;
use Zingular\Forms\Condition;
use Zingular\Forms\Exception\FormException;
use Zingular\Forms\Plugins\Conditions\ConditionInterface;

/**
 * Class CallbackCondition
 * @package Zingular\Forms\Service\Condition
 */
class CallbackCondition implements ConditionInterface
{
    /**
     * @return string
     */
    public function getName()
    {
        return Condition::CALLBACK;
    }

    /**
     * @param ComponentInterface $source
     * @param FormState $state
     * @param array $params
     * @return bool
     * @throws FormException
     */
    public function isValid(ComponentInterface $source, FormState $state, array $params = array())
    {
        if(!isset($params[0]))
        {
            throw new FormException(sprintf("Missing callable for condition of type 'callback' for component '%s'!",$source->getId()),'condition.missingCallback');
        }
        elseif(!is_callable($params[0]))
        {
            throw new FormException(sprintf("Invalid callable for condition of type 'callback' for component '%s'!",$source->getId()),'condition.incorrectCallback');
        }

        if(isset($params[1]) && (bool) $params[1])
        {
            return call_user_func($params[0],$source,$state);
        }
        else
        {
            return call_user_func($params[0],$source);
        }
    }
}