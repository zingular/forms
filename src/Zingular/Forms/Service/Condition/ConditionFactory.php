<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 10:59
 */

namespace Zingular\Forms\Service\Condition;
use Zingular\Forms\Condition;
use Zingular\Forms\Plugins\Conditions\ConditionInterface;
use Zingular\Forms\Plugins\Conditions\ValueCondition;

/**
 * Class ConditionFactory
 * @package Zingular\Form\Service\Condition
 */
class ConditionFactory implements ConditionFactoryInterface
{
    /**
     * @var array
     */
    protected $types = array
    (
        Condition::STARTS_WITH,
        Condition::VALUE
    );

    /**
     * @param string $type
     * @return ConditionInterface
     */
    public function create($type)
    {
        return new ValueCondition();
    }

    /**
     * @param $type
     * @return bool
     */
    public function has($type)
    {
        return in_array($type,$this->types);
    }
}