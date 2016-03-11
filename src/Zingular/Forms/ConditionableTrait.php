<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 10-3-2016
 * Time: 22:52
 */

namespace Zingular\Forms;
use Zingular\Forms\Component\FormState;
use Zingular\Forms\Plugins\Conditions\ConditionGroup;

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
        $condition = new ConditionGroup($this,$params);

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
            $condition->execute();
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