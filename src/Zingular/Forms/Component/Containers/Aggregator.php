<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 30-1-2016
 * Time: 14:50
 */

namespace Zingular\Forms\Component\Containers;
use Zingular\Forms\Aggregation;
use Zingular\Forms\AggregationMode;
use Zingular\Forms\Component\ConvertableTrait;
use Zingular\Forms\Component\DataUnitComponentInterface;
use Zingular\Forms\Component\DataUnitTrait;
use Zingular\Forms\Component\FormState;
use Zingular\Forms\Component\RequiredInterface;
use Zingular\Forms\Component\RequiredTrait;

use Zingular\Forms\Exception\ComponentException;

use Zingular\Forms\IncompletionMode;
use Zingular\Forms\Plugins\Aggregators\AggregatorInterface;
use Zingular\Forms\Exception\FormException;
use Zingular\Forms\RequiredMode;

/**
 * Class Aggregator
 * @package Zingular\Form
 */
class Aggregator extends Container implements DataUnitComponentInterface,RequiredInterface
{
    use DataUnitTrait;
    use RequiredTrait;
    use ConvertableTrait;

    /**
     * @var array
     */
    protected $values = array();

    /**
     * @var bool
     */
    protected $emptyIsValue = false;

    /**
     * @var AggregatorInterface
     */
    protected $aggregator;

    /**
     * @var string
     */
    protected $aggregatorType = Aggregation::NONE;

    /**
     * @var string
     */
    protected $requiredMode = RequiredMode::ANY;

    /**
     * @var string
     */
    protected $aggregationMode = AggregationMode::ALL;

    /**
     * @var string
     */
    protected $incompletionMode = IncompletionMode::IGNORE;

    /**
     * @param FormState $state
     * @param array $defaultValues
     * @return string
     */
    public function compile(FormState $state,array $defaultValues = array())
    {
        // store the form context locally
        $this->state = $state;

        // default value
        $defaultValue = null;

        // extract the default value for this aggregator from the default values
        if(array_key_exists($this->getName(),$defaultValues))
        {
            // set the default value from the set value
            $defaultValue = $defaultValues[$this->getName()];

            // overwrite the default values by de-aggregating the default value
            $defaultValues = $this->deaggregate($this->decodeValue($defaultValue));//$this->getAggregationStrategy()->deaggegate($this->decodeValue($defaultValue),$this);


            // TODO: apply native deaggregation here

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
        parent::compile($state,$defaultValues);

        // make sure the value is collected, with the collected default value
        $this->retrieveValue($defaultValue);
    }

    /***********************************************************************
     * VALUE RETRIEVING
     **********************************************************************/

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
                    throw new FormException($this,'validator.required',array('control'=>$this->getServices()->getTranslator()->translate('control.'.$this->getName())));
                }
            }
            // if there was a value from the input
            else
            {
                // evaluate the value
                $this->setValue($this->getServices()->getEvaluationHandler()->evaluate($this,$this->getEvaluatorCollection()));

                // encode the value (if converter set)
                $this->setValue($this->encodeValue($this->value));

                // store the read input if it should be persisted
                if($this->isPersistent() || $this->state->isPersistent())
                {
                    $this->getServices()->getPersistenceHandler()->setValue($this->getFullName(),$this->value,$this->state->getFormId());
                }
            }
        }
        // if input should not be read, get value from other source
        else
        {
            // if persistent and the persistence handler has a value for this data unit, load it
            if(($this->isPersistent() || $this->state->isPersistent()) && $this->getServices()->getPersistenceHandler()->hasValue($this->getFullName(),$this->state->getFormId()))
            {
                $this->setValue($this->getServices()->getPersistenceHandler()->getValue($this->getFullName(),$this->state->getFormId()));
            }
        }
    }

    /**
     * @param FormState $state
     * @return bool
     */
    protected function shouldReadInput(FormState $state)
    {
        return $state->hasSubmit() && !$this->hasFixedValue();
    }

    /**
     * @param FormState $state
     * @return mixed
     */
    protected function readInput(FormState $state)
    {
        $raw = $this->values;

        // todo: check required mode

        $aggregated = $this->aggregate($raw);

        return $aggregated;
    }

    /**
     * @param DataUnitComponentInterface $child
     */
    protected function storeValue(DataUnitComponentInterface $child)
    {
        // add the value of the component to the values of this container
        $this->values[$child->getName()] = $child->getValue();

        // also store the value the standard way
        parent::storeValue($child);
    }

    /***********************************************************************
     * CSS
     **********************************************************************/

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

    /***********************************************************************
     * AGGREGATION
     **********************************************************************/

    /**
     * @param $value
     * @return mixed
     */
    protected function aggregate($value)
    {
        return $this->getAggregationStrategy()->aggregate($value,$this);
    }

    /**
     * @param $value
     * @return array
     */
    protected function deaggregate($value)
    {
        return $this->getAggregationStrategy()->deaggegate($value,$this);
    }

    /**
     * @param string $strategy
     * @return $this
     */
    public function setAggregationType($strategy)
    {
        $this->aggregatorType = $strategy;
        return $this;
    }

    /**
     * @param string $mode
     * @return $this
     */
    public function setAggregationMode($mode = AggregationMode::ALL)
    {
        $this->aggregationMode = $mode;
        return $this;
    }

    /**
     * @param string $mode
     * @return $this
     */
    public function setRequiredMode($mode = RequiredMode::ANY)
    {
        $this->setRequiredMode($mode);
        return $this;
    }

    /**
     * @param string $mode
     */
    public function setIncompletionMode($mode = IncompletionMode::IGNORE)
    {
        $this->incompletionMode = $mode;
    }

    /**
     * @return AggregatorInterface
     * @throws FormException
     */
    protected function getAggregationStrategy()
    {
        if(is_null($this->aggregator))
        {
            $this->aggregator = $this->getServices()->getAggregators()->get($this->aggregatorType);
        }
        return $this->aggregator;
    }

    /***********************************************************************
     * MISC
     **********************************************************************/

    /**
     * @return array
     */
    protected function describeSelf()
    {
        return array_merge(parent::describeSelf(),array('aggregationStrategyType'=>$this->aggregatorType));
    }

    /**
     * @return string
     */
    public function getDataPath()
    {
        return trim($this->context->getDataPath().'/'.$this->getName(),'/');
    }
}