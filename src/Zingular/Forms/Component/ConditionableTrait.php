<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 10-3-2016
 * Time: 22:52
 */

namespace Zingular\Forms\Component;
use Zingular\Forms\Condition;
use Zingular\Forms\Plugins\Conditions\ConditionGroup;
use Zingular\Forms\Validator;

/**
 * Class ConditionableTrait
 * @package Zingular\Forms
 */
trait ConditionableTrait
{
    /**
     * @var array
     */
    protected $conditions = array();

    /**
     * @param $condition
     * @param ...$params
     * @return static
     */
    public function addCondition($condition, ...$params)
    {
        $condition = new ConditionGroup($this,$condition,$params);

        $this->conditions[] = $condition;

        return $condition;
    }

    /**
     * @param $field
     * @param string $validator
     * @param ...$params
     * @return static
     */
    public function addConditionOn($field,$validator = Validator::HAS_VALUE,...$params)
    {
        $condition = new ConditionGroup($this,Condition::VALUE,func_get_args());

        $this->conditions[] = $condition;

        return $condition;
    }

    /**
     * @param FormState $state
     */
    public function applyConditions(FormState $state)
    {
        /** @var ConditionGroup $condition */
        foreach($this->conditions as $condition)
        {
            $condition->execute($state);
        }
    }

    /**
     * @return static
     */
    public function endCondition()
    {
        return $this;
    }
}