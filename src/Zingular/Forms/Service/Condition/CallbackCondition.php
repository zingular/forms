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
        Condition::CALLBACK;
    }

    /**
     * @param ComponentInterface $source
     * @param array $params
     * @param FormState $state
     * @return mixed
     */
    public function isValid(ComponentInterface $source, array $params = array(), FormState $state)
    {
        return call_user_func($params[0],$state);
    }
}