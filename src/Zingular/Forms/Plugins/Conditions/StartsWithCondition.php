<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 11-3-2016
 * Time: 20:11
 */

namespace Zingular\Forms\Plugins\Conditions;

use Zingular\Forms\Component\ComponentInterface;
use Zingular\Forms\Component\FormState;
use Zingular\Forms\Condition;

/**
 * Class StartsWithCondition
 * @package Zingular\Forms\Plugins\Conditions
 */
class StartsWithCondition implements ConditionInterface
{
    /**
     * @return string
     */
    public function getName()
    {
        return Condition::STARTS_WITH;
    }

    /**
     * @param ComponentInterface $source
     * @param array $params
     * @param FormState $state
     * @return mixed
     */
    public function isValid(ComponentInterface $source, array $params = array(), FormState $state)
    {

    }
}