<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 10-2-2016
 * Time: 20:49
 */

namespace Zingular\Forms\Component;

use Zingular\Forms\Exception\ComponentException;
use Zingular\Forms\Exception\FormException;
use Zingular\Forms\Service\Evaluation\FilterConfig;
use Zingular\Forms\Service\Evaluation\ValidatorConfig;

/**
 * Class DataUnitComponentTrait
 * @package Zingular\Form\Component
 */
trait DataUnitComponentTrait
{
    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var bool
     */
    protected $hasFixedValue = false;

    /**
     * @var bool
     */
    protected $ignoreValue = false;

    /**
     * @var bool
     */
    protected $ignoreWhenEmpty = false;

    /**
     * @var bool
     */
    protected $persistent = false;

    /**
     * @var array
     */
    protected $evaluators = array();

    /***************************************************************
     * COMPILING
     **************************************************************/

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasValue()
    {
        return !is_null($this->value);
    }

    /**
     * @return bool
     */
    public function hasFixedValue()
    {
        return $this->hasFixedValue;
    }

    /**
     * @param bool $set
     * @return $this
     */
    public function fixedValue($set = true)
    {
        $this->hasFixedValue = $set;
        return $this;
    }

    /**
     * @param bool $set
     * @return $this
     */
    public function ignoreValue($set = true)
    {
        $this->ignoreValue = $set;
        return $this;
    }

    /**
     * @return bool
     */
    public function shouldIgnoreValue()
    {
        return $this->ignoreValue || (!$this->hasValue() && $this->ignoreWhenEmpty);
    }

    /**
     * @param bool $set
     * @return $this
     */
    public function ignoreWhenEmpty($set = true)
    {
        $this->ignoreWhenEmpty = $set;
        return $this;
    }


    /**
     * @param bool $set
     * @return $this
     */
    public function persistent($set = true)
    {
        $this->persistent = $set;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPersistent()
    {
        return $this->persistent;
    }

    /***************************************************************
     * EVALUATION
     **************************************************************/

    /**
     * @param callable|string $filter
     * @param ...$args
     * @return $this
     */
    public function addFilter($filter,...$args)
    {
        $this->evaluators[] = new FilterConfig($filter,$args);
        return $this;
    }


    /**
     * @param callable|string
     * @param ...$args
     * @return $this
     */
    public function addValidator($validator,...$args)
    {
        $this->evaluators[] = new ValidatorConfig($validator,$args);
        return $this;
    }
}