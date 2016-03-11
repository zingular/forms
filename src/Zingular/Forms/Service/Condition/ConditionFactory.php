<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 10:59
 */

namespace Zingular\Forms\Service\Condition;
use Zingular\Forms\Condition;
use Zingular\Forms\Exception\FormException;
use Zingular\Forms\Plugins\Conditions\ConditionInterface;
use Zingular\Forms\Plugins\Conditions\StartsWithCondition;
use Zingular\Forms\Plugins\Conditions\ValueCondition;

/**
 * Class ConditionFactory
 * @package Zingular\Form\Service\ConditionGroup
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
     * @param $type
     * @param array $options
     * @return ConditionInterface
     * @throws FormException
     */
    public function create($type,array $options = array())
    {
        switch($type)
        {
            case Condition::VALUE: return new ValueCondition();
            case Condition::STARTS_WITH: return new StartsWithCondition();
        }

        throw new FormException(sprintf("Cannot create condition: unknown condition type '%s'",$type));
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