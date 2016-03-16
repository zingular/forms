<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 15-3-2016
 * Time: 20:59
 */

namespace Zingular\Forms\Component;
use Zingular\Forms\Condition;
use Zingular\Forms\Exception\FormException;
use Zingular\Forms\Plugins\Conditions\ConditionGroup;
use Zingular\Forms\Validator;

/**
 * Class ConditionableTrait
 * @package Zingular\Forms\Component
 */
trait ConditionableTrait
{
    /**
     * @var array
     */
    protected $conditionGroups = array();

    /**********************************************************************
     * VIEW
     *********************************************************************/

    /**
     * @param $condition
     * @param ...$params
     * @return static
     */
    public function ifCondition($condition, ...$params)
    {
        $group = new ConditionGroup($this,$condition,$params);
        $this->conditionGroups[] = $group;
        return $group;
    }

    /**
     * @param $condition
     * @param ...$params
     * @return static
     * @throws FormException
     */
    public function orCondition($condition, ...$params)
    {
        throw new FormException(sprintf("Cannot add OR condition to component '%': no condition active!",$this->getId()));
    }

    /**
     * @param string $condition
     * @param ...$params
     * @return static
     * @throws FormException
     */
    public function elseCondition($condition = Condition::TRUE, ...$params)
    {
        throw new FormException(sprintf("Cannot add ELSE condition to component '%': no condition active!",$this->getId()));
    }

    /**
     * @param string $field
     * @param $validator
     * @param ...$params
     * @return static
     */
    public function addConditionOn($field, $validator = Validator::HAS_VALUE, ...$params)
    {
        // TODO
    }

    /**
     * @throws FormException
     * @return static
     */
    public function endCondition()
    {
        throw new FormException(sprintf("Cannot END condition for component '%': no condition active!",$this->getId()));
    }

    /**
     * @param FormState $state
     * @return array
     */
    public function applyConditions(FormState $state)
    {
        return $this->doApplyConditions($this->conditionGroups,$state);
    }

    /**
     * @param array $conditionGroups
     * @param FormState $state
     * @return array
     */
    protected function doApplyConditions(array $conditionGroups,FormState $state)
    {
        /** @var ConditionGroup $conditionGroup */
        foreach($conditionGroups as $conditionGroup)
        {
            // recursively apply the conditions
            $this->doApplyConditions($conditionGroup->execute($state,$this),$state);
        }

        return array();
    }
}