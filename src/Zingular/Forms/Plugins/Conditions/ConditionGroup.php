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
     * @param ComponentInterface $subject
     * @param $condition
     * @param array $params
     * @param ComponentInterface $return
     */
    public function __construct(ComponentInterface $subject,$condition,array $params = array(),ComponentInterface $return = null)
    {
        $this->subject = $subject;
        $this->condition = $condition;
        $this->params = $params;
        $this->return = is_null($return) ? $subject->getParent() : $return;
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
     */
    public function execute(FormState $state)
    {
        // if condition was successful, apply the callbacks
        if($this->isValid($state))
        {
            $component = $this->subject;

            foreach($this->callbacks as $callback)
            {
                $component = call_user_func($callback,$component);
            }
        }
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
     * @return ComponentInterface
     */
    public function endCondition()
    {
        return $this->return;
    }
}