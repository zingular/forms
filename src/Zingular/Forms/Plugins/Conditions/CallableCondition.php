<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 11:02
 */

namespace Zingular\Forms\Plugins\Conditions;

use Zingular\Forms\Component\ComponentInterface;
use Zingular\Forms\Component\FormState;


/**
 * Class CallableCondition
 * @package Zingular\Form\Service\ConditionGroup
 */
class CallableCondition implements ConditionInterface
{
    /**
     * @var callable
     */
    protected $callable;

    /**
     * @var bool
     */
    protected $contextAware;

    /**
     * @param callable $callable
     * @param bool $contextAware
     */
    public function __construct($callable,$contextAware = false)
    {
        $this->callable = $callable;
        $this->contextAware = $contextAware;
    }

    /**
     * @param ComponentInterface $source
     * @param array $params
     * @param FormState $state
     * @return bool
     */
    public function isValid(ComponentInterface $source,FormState $state, array $params = array())
    {
        if($this->contextAware)
        {
            return call_user_func_array($this->callable,array_merge(array($source,$state),$params));
        }

        return call_user_func_array($this->callable,array_merge(array($source),$params));
    }
}