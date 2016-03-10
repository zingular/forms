<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 10-3-2016
 * Time: 22:24
 */

namespace Zingular\Forms\Plugins\Conditions;
use Zingular\Forms\Component\ComponentInterface;

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
     * @var array
     */
    protected $params;

    /**
     * @var array
     */
    protected $callbacks = array();

    /**
     * @param ComponentInterface $component
     * @param array $params
     */
    public function __construct(ComponentInterface $component,array $params)
    {
        $this->component = $component;
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
     *
     */
    public function execute()
    {
        // TODO: check condition, and if it succeeds, call callbacks

        $component = $this->component;


        if($this->params[0] === true)
        {
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