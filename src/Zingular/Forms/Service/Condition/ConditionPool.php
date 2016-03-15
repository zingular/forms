<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 17:34
 */

namespace Zingular\Forms\Service\Condition;



use Zingular\Forms\Plugins\Conditions\ConditionInterface;
use Zingular\Forms\Plugins\Conditions\ConditionTypeInterface;

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
     * @var ConditionFactoryInterface
     */
    protected $factory;

    /**
     * @param ConditionFactoryInterface $factory
     */
    public function __construct(ConditionFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param ConditionTypeInterface $condition
     */
    public function add(ConditionTypeInterface $condition)
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
     * @param string $name
     * @return ConditionInterface
     */
    public function get($name)
    {
        if($this->has($name))
        {
            return $this->pool[$name];
        }

        $condition = $this->factory->create($name);

        $this->pool[$name] = $condition;

        return $condition;
    }
}