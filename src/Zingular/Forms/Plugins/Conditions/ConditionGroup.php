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
     * @var array
     */
    protected $callbacks = array();

    /**
     * @var int
     */
    protected $position;

    /**
     * @var self
     */
    protected $currentNestedCondition = 0;

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
        $this->callbacks[] = function($component) use ($method,$args){return call_user_func_array(array($component,$method),$args);};
        return $this;
    }

    /**
     * @param FormState $state
     * @return array
     */
    public function execute(FormState $state)
    {
        $newConditions = array();

        // if condition was successful, apply the callbacks
        if($this->isValid($state))
        {
            $component = $this->subject;

            foreach($this->callbacks as $callback)
            {
                $component = call_user_func($callback,$component);

                if($component instanceof ConditionGroup)
                {
                    $newConditions[spl_object_hash($component)] = $component;
                }
            }
        }

        return $newConditions;
    }

    /**
     * @param FormState $state
     * @return mixed
     */
    protected function isValid(FormState $state)
    {
        // get the condition instance from the pool
        $condition = $state->getServices()->getConditions()->get($this->condition);

        // check the condition
        return $condition->isValid($this->subject,$this->params,$state);
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
     * @return ComponentInterface
     */
    public function endCondition()
    {
        $nested = $this->currentNestedCondition;
        $this->currentNestedCondition--;

        return $nested > 0 ? $this->subject->endCondition() : $this;
    }
}