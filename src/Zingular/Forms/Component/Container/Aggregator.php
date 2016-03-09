<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 30-1-2016
 * Time: 14:50
 */

namespace Zingular\Forms\Component\Container;
use Zingular\Forms\Aggregation;
use Zingular\Forms\Component\DataUnitInterface;
use Zingular\Forms\Component\DataUnitTrait;
use Zingular\Forms\Component\FormContext;
use Zingular\Forms\Component\RequiredInterface;
use Zingular\Forms\Component\RequiredTrait;
use Zingular\Forms\Exception\EvaluationException;
use Zingular\Forms\Plugins\Aggregators\AggregatorInterface;
use Zingular\Forms\Exception\FormException;

/**
 * Class Aggregator
 * @package Zingular\Form
 */
class Aggregator extends Container implements DataUnitInterface,RequiredInterface
{
    use DataUnitTrait;
    use RequiredTrait;

    /**
     * @var AggregatorInterface
     */
    protected $aggregationStrategy;

    /**
     * @var string
     */
    protected $aggregationStrategyType = Aggregation::NONE;

    /**
     * @param FormContext $formContext
     * @param array $defaultValues
     * @return string
     */
    public function compile(FormContext $formContext,array $defaultValues = array())
    {
        // store the form context locally
        $this->formContext = $formContext;

        // default value
        $defaultValue = null;

        // extract the default value for this aggregator from the default values
        if(array_key_exists($this->getName(),$defaultValues))
        {
            // set the default value from the set value
            $defaultValue = $defaultValues[$this->getName()];

            // overwrite the default values by de-aggregating the default value
            $defaultValues = $this->getAggregationStrategy()->deaggegate($defaultValue,$this);

            if(!is_array($defaultValues))
            {
                $defaultValues = array();
            }
        }
        // if there was no default value provided for this aggregator, there are no default values to be set for childs
        else
        {
            $defaultValues = array();
        }

        // compile the parent using the de-aggregated value as default values for child components
        parent::compile($formContext,$defaultValues);

        // make sure the value is collected, with the collected default value
        $this->retrieveValue($defaultValue);
    }



    /**
     * @param null $defaultValue
     * @throws EvaluationException
     */
    public function retrieveValue($defaultValue = null)
    {
        // if there was a form scope default value provided, set that
        if(!is_null($defaultValue))
        {
            $this->value = $defaultValue;
        }

        // if there was a submit
        if($this->shouldReadInput($this->formContext))
        {
            // read the raw value
            $this->value = $this->readInput();

            // if there was no value from the input
            if($this->hasValue() === false)
            {
                // check required
                if($this->isRequired())
                {
                    throw new EvaluationException($this,'required',array('control'=>$this->getServices()->getTranslator()->translate('control.'.$this->getName())));
                }
            }
            // if there was a value from the input
            else
            {
                // evaluate the value
                $this->value = $this->getServices()->getEvaluationHandler()->evaluate($this->value,$this->getEvaluatorCollection(),$this);

                // encode the value (if converter set)
                // TODO
                //$this->value = $this->encodeValue($this->value);

                // store the read input if it should be persisted
                if($this->isPersistent() || $this->formContext->isPersistent())
                {
                    $this->getServices()->getPersistenceHandler()->setValue($this->getFullName(),$this->value,$this->formContext->getFormId());
                }
            }
        }
        // if input should not be read, get value from other source
        else
        {
            // if persistent and the persistence handler has a value for this data unit, load it
            if(($this->isPersistent() || $this->formContext->isPersistent()) && $this->getServices()->getPersistenceHandler()->hasValue($this->getFullName(),$this->formContext->getFormId()))
            {
                $this->value = $this->getServices()->getPersistenceHandler()->getValue($this->getFullName(),$this->formContext->getFormId());
            }
        }
    }

    /**
     * @param FormContext $formContext
     * @return bool
     */
    protected function shouldReadInput(FormContext $formContext)
    {
        return $formContext->hasSubmit() && !$this->hasFixedValue();
    }

    /**
     * @return mixed
     */
    protected function readInput()
    {
        return $this->preprocessInputValue($this->getAggregationStrategy()->aggregate($this->getValues(),$this));
    }

    /**
     * @param $value
     * @return bool
     */
    protected function preprocessInputValue($value)
    {
        // TODO: check required mode and make sure a null value is returned if not all of the conditions are met

        return $value;
    }











    /**
     * @return array
     */
    protected function getRuntimeClasses()
    {
        $classes = array();

        if($this->isRequired())
        {
            $classes[] = 'required';
        }

        return $classes;
    }












    /**
     * @param string $strategy
     * @return $this
     */
    public function setAggregationType($strategy)
    {
        $this->aggregationStrategyType = $strategy;
        return $this;
    }

    /**
     * @return \Zingular\Forms\Plugins\Aggregators\AggregatorInterface
     * @throws FormException
     */
    protected function getAggregationStrategy()
    {
        if(is_null($this->aggregationStrategy))
        {
            $this->aggregationStrategy = $this->getServices()->getAggregators()->get($this->aggregationStrategyType);
        }
        return $this->aggregationStrategy;
    }

        /**
     * @return array
     */
    protected function describeSelf()
    {
        return array_merge(parent::describeSelf(),array('aggregationStrategyType'=>$this->aggregationStrategyType));
    }

    /**
     * @return string
     */
    public function getDataPath()
    {
        return trim($this->context->getDataPath().'/'.$this->getName(),'/');
    }

    /**
     * @param $converter
     * @param $args
     * @return $this
     */
    public function setConverter($converter,...$args)
    {
        // TODO
    }
}