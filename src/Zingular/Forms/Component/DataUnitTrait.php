<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 10-2-2016
 * Time: 20:49
 */

namespace Zingular\Forms\Component;
use Zingular\Forms\Service\Evaluation\EvaluationHandler;
use Zingular\Forms\Service\Evaluation\EvaluatorConfigCollection;
use Zingular\Forms\Service\Evaluation\FilterConfig;
use Zingular\Forms\Service\Evaluation\ValidatorConfig;

/**
 * Class DataUnitTrait
 * @package Zingular\Form\Component
 */
trait DataUnitTrait
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
    protected $emptyStringIsValue = true;

    /**
     * @var bool
     */
    protected $persistent = false;

    /**
     * @var EvaluationHandler
     */
    protected $evaluationHandler;

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
    public function setEmptyStringIsValue($set = true)
    {
        $this->emptyStringIsValue = $set;
        return $this;
    }

    /**
     * @return bool
     */
    public function emptyStringIsValue()
    {
        return $this->emptyStringIsValue;
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
        $this->getEvaluatorCollection()->addEvaluator(new FilterConfig($filter,$args));
        return $this;
    }


    /**
     * @param callable|string
     * @param ...$args
     * @return $this
     */
    public function addValidator($validator,...$args)
    {
        $this->getEvaluatorCollection()->addEvaluator(new ValidatorConfig($validator,$args));
        return $this;
    }

    /**
     * @return EvaluatorConfigCollection
     */
    protected function getEvaluatorCollection()
    {
        if(is_null($this->evaluationHandler))
        {
            $this->evaluationHandler = new EvaluatorConfigCollection();
        }

        return $this->evaluationHandler;
    }


    /***************************************************************
     * NAME
     **************************************************************/

    /**
     * @return string
     */
    public function getName()
    {
        return $this->context->getName();
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->context->getFullName();
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->context->setName($name);
        return $this;
    }
}