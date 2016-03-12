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
    protected $component;

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
     * @param ComponentInterface $component
     * @param $condition
     * @param array $params
     */
    public function __construct(ComponentInterface $component,$condition,array $params = array())
    {
        $this->component = $component;
        $this->condition = $condition;
        $this->params = $params;
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
        // get the condition instance from the pool
        $condition = $state->getServices()->getConditions()->get($this->condition);

        // check the condition
        $valid = $condition->isValid($this->component,$this->params,$state);

        // if condition was successful, apply the callbacks
        if($valid)
        {
            $component = $this->component;

            foreach($this->callbacks as $callback)
            {
                $component = call_user_func($callback,$component);
            }
        }
    }

    /**
     * @return ComponentInterface
     */
    public function endCondition()
    {
        return $this->component;
    }
}