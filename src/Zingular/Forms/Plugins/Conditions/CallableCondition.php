<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 11:02
 */

namespace Zingular\Forms\Plugins\Conditions;

use Zingular\Forms\Component\ComponentInterface;
use Zingular\Forms\Component\FormContext;


/**
 * Class CallableCondition
 * @package Zingular\Form\Service\Condition
 */
class CallableCondition implements ConditionInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var callable
     */
    protected $callable;

    /**
     * @var bool
     */
    protected $contextAware;

    /**
     * @param $name
     * @param callable $callable
     * @param bool $contextAware
     */
    public function __construct($name,callable $callable,$contextAware = false)
    {
        $this->name = $name;
        $this->callable = $callable;
        $this->contextAware = $contextAware;
    }

    /**
     * @param ComponentInterface $source
     * @param array $params
     * @param FormContext $context
     * @return mixed
     */
    public function isValid(ComponentInterface $source, array $params = array(),FormContext $context)
    {
        return $this->contextAware ? call_user_func($this->callable,$source,$params,$context) : call_user_func($this->callable,$source,$params);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}