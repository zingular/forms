<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 10-3-2016
 * Time: 22:15
 */

namespace Zingular\Forms\Component;
use Zingular\Forms\Condition;
use Zingular\Forms\Validator;

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
    public function ifCondition($condition,...$params);

    /**
     * @param $condition
     * @param ...$params
     * @return static
     */
    public function orCondition($condition, ...$params);

    /**
     * @param string $condition
     * @param ...$params
     * @return static
     */
    public function elseCondition($condition = Condition::TRUE,...$params);

    /**
     * @param string $field
     * @param $validator
     * @param ...$params
     * @return static
     */
    public function addConditionOn($field,$validator = Validator::HAS_VALUE,...$params);

    /**
     * @return static
     */
    public function endCondition();

    /**
     * @param FormState $state
     * @return array
     */
    public function applyConditions(FormState $state);
}