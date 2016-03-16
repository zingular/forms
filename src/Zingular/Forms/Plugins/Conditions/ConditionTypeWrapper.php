<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 15-3-2016
 * Time: 22:41
 */

namespace Zingular\Forms\Plugins\Conditions;

use Zingular\Forms\Component\ComponentInterface;
use Zingular\Forms\Component\FormState;

/**
 * Class ConditionTypeWrapper
 * @package Zingular\Forms\Plugins\Conditions
 */
class ConditionTypeWrapper implements ConditionTypeInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var ConditionInterface
     */
    protected $condition;

    /**
     * @param $name
     * @param ConditionInterface $condition
     */
    public function __construct($name,ConditionInterface $condition)
    {
        $this->name = $name;
        $this->condition = $condition;
    }

    /**
     * @param ComponentInterface $source
     * @param array $params
     * @param FormState $state
     * @return bool
     */
    public function isValid(ComponentInterface $source, FormState $state, array $params = array())
    {
        return $this->condition->isValid($source,$state,$params);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}