<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 10-3-2016
 * Time: 22:24
 */

namespace Zingular\Forms\Plugins\Conditions;
use Zingular\Forms\Component\ComponentInterface;

use Zingular\Forms\Component\ConditionableInterface;
use Zingular\Forms\Component\FormState;
use Zingular\Forms\Condition;
use Zingular\Forms\Validator;

/**
 * Class ConditionGroup
 * @package Zingular\Forms\Plugins\Conditions
 */
class ConditionGroup// implements ConditionableInterface
{
    /**
     * @var ComponentInterface
     */
    protected $subject;

    /**
     * @var array
     */
    protected $conditions = array();

    /**
     * @var array
     */
    protected $elseConditions = array();

    /**
     * @var array
     */
    protected $commands = array();

    /**
     * @var array
     */
    protected $elseCommands = array();

    /**
     * @var int
     */
    protected $position;

    /**
     * @var self
     */
    protected $currentNestedCondition = 0;

    /**
     * @var string
     */
    protected $mode = 'if';

    /**
     * @param ComponentInterface $subject
     * @param $condition
     * @param array $params
     * @param int $position
     */
    public function __construct(ComponentInterface $subject,$condition,array $params = array(),$position = 0)
    {
        $this->subject = $subject;
        $this->addIfCondition($condition,$params);
        $this->position = $position;
    }


    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }


    /************************************************************************
     * CONDITIONABLE INTERFACE
     ***********************************************************************/

    /**
     * @param $condition
     * @param ...$params
     * @return static
     */
    public function addCondition($condition, ...$params)
    {
        // log the condition call
        $this->__call(__FUNCTION__,func_get_args());

        // add a level to the nested conditions
        $this->currentNestedCondition++;

        return $this;
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
        return $this;
    }

    /**
     * @param $condition
     * @param ...$params
     * @return static
     */
    public function orCondition($condition, ...$params)
    {
        // if there are currently no nested conditions, direct the or condition to this group
        if($this->currentNestedCondition === 0)
        {
            // add IF condition
            if($this->mode === 'if')
            {
                $this->addIfCondition($condition,$params);
            }
            // add ELSE condition
            else
            {
                $this->addElseCondition($condition,$params);
            }
        }
        else
        {
            $this->__call(__FUNCTION__,func_get_args());
        }

        return $this;
    }

    /**
     * @param string $condition
     * @param ...$params
     * @return static
     */
    public function elseCondition($condition = Condition::TRUE,...$params)
    {
        // if there is no nested condition, the else was directed to this condition
        if($this->currentNestedCondition === 0)
        {
            // swap mode to else-mode
            $this->mode = 'else';

            // add the else condition
            $this->addElseCondition($condition,$params);
        }
        // if there is a nested condition, simply log the call
        else
        {
            $this->__call(__FUNCTION__,func_get_args());
        }

        return $this;
    }

    /**
     * @return ComponentInterface
     */
    public function endCondition()
    {
        $this->currentNestedCondition--;
        $nested = $this->currentNestedCondition;
        return $nested > 0 ? $this : $this->subject;
    }

    /************************************************************************
     * OTHER PUBLIC
     ***********************************************************************/

    /**
     * @param $method
     * @param array $args
     * @return $this
     */
    public function __call($method,array $args)
    {
        // create a new callback for the call to allow delayed calling
        $callback = function ($component) use ($method, $args)
        {
            return call_user_func_array(array($component, $method), $args);
        };

        // add it to IF stack, if mode is IF
        if($this->mode === 'if')
        {
            $this->commands[] = $callback;
        }
        // add it to ELSE stack, if mode is ELSE
        else
        {
            $this->elseCommands[] = $callback;
        }

        return $this;
    }

    /**
     * @param FormState $state
     * @param ComponentInterface $component
     * @return array
     */
    public function execute(FormState $state,ComponentInterface $component)
    {
        // try to validate the IF conditions
        if($this->validateConditions($this->conditions,$state))
        {
            // if IF conditions succeed, process the IF commands
            return $this->processCommands($this->commands,$component);
        }
        // try to validate the ELSE conditions
        elseif($this->validateConditions($this->elseConditions,$state))
        {
            // if ELSE conditions succeed, process the ELSE commands
            return $this->processCommands($this->elseCommands,$component);
        }

        // return an empty array if no conditions validate
        return array();
    }

    /************************************************************************
     * INTERNAL
     ***********************************************************************/

    /**
     * @param $condition
     * @param array $params
     */
    protected function addIfCondition($condition,array $params)
    {
        $this->conditions[] = array($condition,$params);
    }

    /**
     * @param $condition
     * @param array $params
     */
    protected function addElseCondition($condition,array $params)
    {
        $this->elseConditions[] = array($condition,$params);
    }

    /**
     * @param array $commands
     * @return array
     */
    protected function processCommands(array $commands,ComponentInterface $component)
    {
        // create an array for any newly created condition groups
        $newConditions = array();

        // start out with the subject component
        //$component = $this->subject;

        // apply each command
        foreach($commands as $callback)
        {
            // collect its return value as the current component pointer
            $component = call_user_func($callback,$component);

            // if component is another (nested) component group, store it to be recursively processed later
            if($component instanceof ConditionGroup)
            {
                $newConditions[spl_object_hash($component)] = $component;
            }
        }

        // return any nested condition groups
        return $newConditions;
    }

    /**
     * @param array $conditions
     * @param FormState $state
     * @return bool
     */
    protected function validateConditions(array $conditions,FormState $state)
    {
        // if there are no conditions, it evaluates to TRUE
        if(count($conditions) === 0)
        {
            return true;
        }

        // check each conditions as OR logic (ANY with true will trigger TRUE)
        foreach($conditions as $condition)
        {
            if($this->conditionIsValid($state,$condition[0],$condition[1]))
            {
                return true;
            }
        }

        // if NO condition validates, return false
        return false;
    }

    /**
     * @param FormState $state
     * @param $condition
     * @param array $params
     * @return bool
     */
    protected function conditionIsValid(FormState $state,$condition,array $params)
    {
        // get the condition instance from the pool
        $condition = $state->getServices()->getConditions()->get($condition);

        // check the condition
        return $condition->isValid($this->subject,$state,$params);
    }
}