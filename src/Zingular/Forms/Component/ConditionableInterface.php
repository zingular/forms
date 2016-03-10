<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 10-3-2016
 * Time: 22:15
 */

namespace Zingular\Forms\Component;

/**
 * Interface ConditionableInterface
 * @package Zingular\Forms\Component
 */
interface ConditionableInterface
{
    /**
     * @param $condition
     * @param ...$params
     * @return static
     */
    public function addCondition($condition,...$params);

    /**
     * @return static
     */
    public function endCondition();

    /**
     * @param FormState $state
     */
    public function applyConditions(FormState $state);
}