<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 16:16
 */

namespace Zingular\Form\Component;
use Zingular\Form\Exception\FormException;
use Zingular\Form\Service\Condition\ConditionGroup;

/**
 * Class ConditionTrait
 * @package Zingular\Form\Component
 */
trait ConditionTrait
{
    /**
     * @var array
     */
    protected $conditions = array();

    /**
     * @var ConditionGroup
     */
    protected $currentConditionGroup;

    /**
     * @param $conditionType
     * @param ...$args
     * @return $this
     */
    public function showIf($conditionType,...$args)
    {
        return $this->newGroup('show',$conditionType,$args);
    }

    /**
     * @param $field
     * @param $condition
     * @param ...$args
     */
    public function showIfField($field,$condition,...$args)
    {

    }

    /**
     * @param $conditionType
     * @param ...$args
     * @return $this
     * @throws FormException
     */
    public function orIf($conditionType,...$args)
    {
        return $this->orCondition($conditionType,$args);
    }





    /**
     * @param $conditionType
     * @param ...$args
     * @return $this
     */
    public function validIf($conditionType,...$args)
    {
        return $this->newGroup('valid',$conditionType,$args);
    }

    /**
     * @param $conditionType
     * @param ...$args
     * @return $this
     */
    public function requiredIf($conditionType,...$args)
    {
        return $this->newGroup('required',$conditionType,$args);
    }

    /**
     * @param $conditionType
     * @param ...$args
     * @return $this
     * @throws FormException
     */
    protected function orCondition($conditionType,...$args)
    {
        if(is_null($this->currentConditionGroup))
        {
            throw new FormException("Cannot process or condition: no current condition group!");
        }

        $this->currentConditionGroup->add($conditionType,$args);

        return $this;
    }

    /**
     * @param $type
     * @param $conditionType
     * @param ...$args
     * @return $this
     */
    protected function newGroup($type,$conditionType,...$args)
    {
        $group = new ConditionGroup($type);
        $group->add($conditionType,$args);
        $this->currentConditionGroup = $group;
        $this->conditions[$type][] = $group;
        return $this;
    }
}