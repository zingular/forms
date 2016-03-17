<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 17-3-2016
 * Time: 19:35
 */

namespace Zingular\Forms\Plugins\Conditions;

/**
 * Class CallableConditionType
 * @package Zingular\Forms\Plugins\Conditions
 */
class CallableConditionType extends CallableCondition implements ConditionTypeInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @param string $name
     * @param callable $callable
     */
    public function __construct($name,$callable)
    {
        parent::__construct($callable);
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}