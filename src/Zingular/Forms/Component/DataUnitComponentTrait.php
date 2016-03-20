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
use Zingular\Forms\Service\Evaluation\EvaluatorConfigCollection;
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

    /**
     * @param null $defaultValue
     * @throws ComponentException
     * @throws FormException
     */
    public function retrieveValue($defaultValue = null)
    {
        // if there was a form scope default value provided, set that
        if(!is_null($defaultValue))
        {
            $this->setValue($defaultValue);
        }

        // if there was a submit
        if($this->shouldReadInput($this->state))
        {
            // read the raw value
            $this->setValue($this->readInput($this->state));

            // if there was no value from the input
            if($this->hasValue() === false)
            {
                // required check
                if($this->isRequired())
                {
                    $params = array('control'=>$this->getTranslator()->translateRaw($this->getTranslationKey(),$this,$this->state));
                    throw new ComponentException($this,'','validator.required',$params);
                }
            }
            // if there was a value from the input
            else
            {
                // evaluate the value
                $this->setValue($this->getEvaluationHandler()->evaluate($this,$this->evaluators));

                // encode the value (if converter set)
                $this->setValue($this->encodeValue($this->value));

                // store the read input if it should be persisted
                if($this->isPersistent() || $this->state->isPersistent())
                {
                    $this->getPersistenceHandler()->setValue($this->getFullName(),$this->value,$this->state->getFormId());
                }
            }
        }
        // if input should not be read, get value from other source
        else
        {
            // if persistent and the persistence handler has a value for this data unit, load it
            if(($this->isPersistent() || $this->state->isPersistent()) && $this->getPersistenceHandler()->hasValue($this->getFullName(),$this->state->getFormId()))
            {
                $this->setValue($this->getPersistenceHandler()->getValue($this->getFullName(),$this->state->getFormId()));
            }
        }
    }

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