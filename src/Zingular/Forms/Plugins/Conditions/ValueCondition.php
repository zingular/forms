<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 11:00
 */

namespace Zingular\Forms\Plugins\Conditions;


use Zingular\Forms\Component\ComponentInterface;
use Zingular\Forms\Component\State;


/**
 * Class ValueCondition
 * @package Zingular\Forms\Plugins\Conditions
 */
class ValueCondition implements ConditionInterface
{


    /**
     * @param ComponentInterface $source
     * @param array $params
     * @param State $context
     * @return mixed
     */
    public function isValid(ComponentInterface $source, array $params = array(),State $context)
    {

    }

    /**
     * @return string
     */
    public function getName()
    {
        // TODO: Implement getName() method.
    }
}