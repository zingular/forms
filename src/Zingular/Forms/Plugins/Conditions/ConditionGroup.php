<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 10-3-2016
 * Time: 22:24
 */

namespace Zingular\Forms\Plugins\Conditions;
use Zingular\Forms\Component\ComponentInterface;
use Zingular\Forms\Component\FormState;
use Zingular\Forms\Condition;

/**
 * Class ConditionGroup
 * @package Zingular\Forms\Plugins\Conditions
 */
class ConditionGroup
{
    /**
     * @var ComponentInterface
     */
    protected $subject;

    /**
     * @var ComponentInterface
     */
    protected $return;

    /**
     * @var string
     */
    protected $condition;

    /**
     * @var array
     */
    protected $params;

    /**
     * @var string
     */
    protected $elseCondition;

    /**
     * @var array
     */
    protected $elseParams;

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
        $this->condition = $condition;
        $this->params = $params;
        $this->position = $position;
    }

    /**
     * @param $method
     * @param array $args
     * @return $this
     */
    public function __call($method,array $args)
    {
        //echo $method.' - '.var_export($args,true).'<br/>';


        $callback = function ($component) use ($method, $args)
        {
            //echo 'EXECUTING: '.$method.' - '.var_export($args,true).'<br/>';
            return call_user_func_array(array($component, $method), $args);
        };

        if ($this->mode == 'if')
        {
            $this->commands[] = $callback;
        }
        else
        {
            $this->elseCommands[] = $callback;
        }

        return $this;
    }

    /**
     * @param FormState $state
     * @return array
     */
    public function execute(FormState $state)
    {
        //echo 'VALIDATING CONDITIONS<br/>';

        if($this->isValid($state,$this->condition,$this->params))
        {
            //echo 'IF is valid - '.var_export($this->params,true).'<br/>';
            return $this->processCommands($this->commands);
        }
        elseif(is_null($this->elseCondition) || $this->isValid($state,$this->elseCondition,$this->elseParams))
        {
            //echo 'ELSE is valid - '.var_export($this->params,true).'<br/>';
            return $this->processCommands($this->elseCommands);
        }

        return array();
    }

    /**
     * @param array $commands
     * @return array
     */
    protected function processCommands(array $commands)
    {
        $newConditions = array();

        $component = $this->subject;

        foreach($commands as $callback)
        {
            //echo 'COMPONENT IS NOW: '.$component->getId().'<br/>';

            $component = call_user_func($callback,$component);

            if($component instanceof ConditionGroup)
            {
                $newConditions[spl_object_hash($component)] = $component;
            }
        }

        return $newConditions;
    }

    /**
     * @param FormState $state
     * @param $condition
     * @param array $params
     * @return bool
     */
    protected function isValid(FormState $state,$condition,array $params)
    {
        // get the condition instance from the pool
        $condition = $state->getServices()->getConditions()->get($condition);

        // check the condition
        return $condition->isValid($this->subject,$params,$state);
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param $condition
     * @param ...$params
     * @return static
     */
    public function addCondition($condition, ...$params)
    {
        $this->__call(__FUNCTION__,func_get_args());

        $this->currentNestedCondition++;


        return $this;
    }


    /**
     * @param string $condition
     * @param ...$params
     * @return $this
     */
    public function elseCondition($condition = Condition::TRUE,...$params)
    {
        if($this->currentNestedCondition === 0)
        {
            $this->mode = 'else';
            $this->elseCondition = $condition;
            $this->elseParams = $params;
        }
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
        return $nested > 0 ? $this->subject->endCondition() : $this;
    }
}