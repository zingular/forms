<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 17:34
 */

namespace Zingular\Forms\Service\Condition;


use Zingular\Forms\Exception\FormException;
use Zingular\Forms\Plugins\Conditions\ConditionInterface;

/**
 * Class ConditionPool
 * @package Zingular\Form\Service\ConditionGroup
 */
class ConditionPool
{
    /**
     * @var array
     */
    protected $pool = array();

    /**
     * @param ConditionInterface $condition
     */
    public function add(ConditionInterface $condition)
    {
        $this->pool[$condition->getName()] = $condition;
    }

    /**
     * @param $name
     * @return bool
     */
    public function has($name)
    {
        return isset($this->pool[$name]);
    }

    /**
     * @param $name
     * @return ConditionInterface
     * @throws FormException
     */
    public function get($name)
    {
        return $this->has($name) ? $this->pool[$name] : null;
    }
}