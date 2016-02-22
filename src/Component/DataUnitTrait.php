<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 10-2-2016
 * Time: 20:49
 */

namespace Zingular\Form\Component;
use Zingular\Form\Service\Evaluation\EvaluationHandler;

use Zingular\Form\Service\Evaluation\EvaluatorConfigCollection;
use Zingular\Form\Service\Evaluation\FilterConfig;
use Zingular\Form\Service\Evaluation\ValidatorConfig;


/**
 * Class DataUnitTrait
 * @package Zingular\Form\Component
 */
trait DataUnitTrait
{
    /**
     * @var Context
     */
    protected $context;

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
     * @var FormContext
     */
    protected $formContext;

    /**
     * @var array
     */
    protected $errors = array();

    /**
     * @var EvaluationHandler
     */
    protected $evaluator;


    /***************************************************************
     * COMPILING
     **************************************************************/





    /***************************************************************
     * VALUE HANDLING
     **************************************************************/

    /**
     * @param FormContext $formContext
     * @return mixed
     */
    protected function readInput(FormContext $formContext)
    {
        return null; // override in parent class
    }

    /**
     * @param FormContext $formContext
     * @param mixed $defaultValue
     * @throws \Exception
     */
    protected function retrieveValue(FormContext $formContext,$defaultValue = null)
    {
        try
        {
            // start out with default value
            if(!is_null($defaultValue))
            {
                $this->value = $defaultValue;
            }

            // if there was a submit
            if($this->shouldReadInput($formContext))
            {
                // read the raw value
                $this->value = $this->readInput($formContext);

                // evaluate the value
                $this->value = $formContext->getServices()->getEvaluationHandler()->evaluate($this->value,$this->getEvaluatorCollection(),$this);

                // store the read input if it should be persisted
                if($this->persistent || $formContext->isPersistent())
                {
                    $formContext->getServices()->getPersistenceHandler()->setValue($this->getFullName(),$this->value,$formContext->getFormId());
                }
            }
            // if input should not be read, get value from other source
            else
            {
                // if persistent and the persistence handler has a value for this data unit, load it
                if(($this->persistent || $formContext->isPersistent()) && $formContext->getServices()->getPersistenceHandler()->hasValue($this->getFullName(),$formContext->getFormId()))
                {
                    $this->value = $formContext->getServices()->getPersistenceHandler()->getValue($this->getFullName(),$formContext->getFormId());
                }
            }
        }
        // catch any exception
        catch(\Exception $e)
        {
            // add an error css class
            $this->addCssClass('error');

            // rethrow the exception
            throw $e;
        }
    }

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
    public function emptyStringIsValue($set = true)
    {
        $this->emptyStringIsValue = $set;
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
     * @param FormContext $formContext
     * @return bool
     */
    protected function shouldReadInput(FormContext $formContext)
    {
        return $formContext->hasSubmit() && !$this->hasFixedValue();
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
        if(is_null($this->evaluator))
        {
            $this->evaluator = new EvaluatorConfigCollection();
        }

        return $this->evaluator;
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