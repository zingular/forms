<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 30-1-2016
 * Time: 16:39
 */

namespace Zingular\Forms\Component\Elements\Controls;
use Zingular\Forms\Component\ConvertableTrait;
use Zingular\Forms\Component\DataUnitComponentInterface;
use Zingular\Forms\Component\DataUnitTrait;
use Zingular\Forms\Component\DescribableInterface;
use Zingular\Forms\Component\Elements\AbstractElement;
use Zingular\Forms\Component\FormState;
use Zingular\Forms\Component\CssComponentInterface;
use Zingular\Forms\Component\RequiredInterface;
use Zingular\Forms\Component\RequiredTrait;
use Zingular\Forms\Exception\EvaluationException;
use Zingular\Forms\Exception\ValidationException;

/**
 * Class AbstractControl
 * @package Zingular\Form
 */
abstract class AbstractControl extends AbstractElement implements
    DataUnitComponentInterface,
    RequiredInterface,
    CssComponentInterface,
    DescribableInterface
{
    use RequiredTrait;
    use DataUnitTrait;
    use ConvertableTrait;

    /**
     * @var bool
     */
    protected $trimValue = true;

    /**
     * @var bool
     */
    protected $emptyStringIsValue = false;

    /**
     * @param FormState $state
     * @param array $defaultValues
     * @return string
     */
    public function compile(FormState $state,array $defaultValues = array())
    {
        // set the form context locally
        $this->state = $state;

        // apply any conditions for this control
        $this->applyConditions($state);

        // manipulate default values
        $defaultValue = array_key_exists($this->getName(),$defaultValues) ? $defaultValues[$this->getName()] : null;

        // make sure the value is collected
        $this->retrieveValue($defaultValue);
    }

    /**
     * @param null $defaultValue
     * @throws EvaluationException
     * @throws ValidationException
     */
    public function retrieveValue($defaultValue = null)
    {
        // if there was a form scope default value provided, set that
        if(!is_null($defaultValue))
        {
            $this->value = $defaultValue;
        }

        // if there was a submit
        if($this->shouldReadInput($this->state))
        {
            // read the raw value
            $this->value = $this->readInput($this->state);

            // if there was no value from the input
            if($this->hasValue() === false)
            {
                // required check
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
                $this->value = $this->encodeValue($this->value);

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
                $this->value = $this->getServices()->getPersistenceHandler()->getValue($this->getFullName(),$this->state->getFormId());
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
     * @return null|string
     */
    protected function readInput(FormState $state)
    {
        // only load input value if it actually was set
        if($state->hasInput($this->getFullName()))
        {
            return $this->preprocessInputValue($state->getInput($this->getFullName()));
        }
        return null;
    }

    /**
     * @param $value
     * @return bool
     */
    protected function preprocessInputValue($value)
    {
        if(is_string($value))
        {
            // trim the raw value
            if($this->shouldTrimValue())
            {
                $value = trim($value);
            }

            // if the value is an empty string, and that is considered empty, return null
            if($this->emptyStringIsValue() === false && strlen($value) === 0)
            {
                return null;
            }

            return $value;
        }

        return null;
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
     * @return array
     */
    public function describe()
    {
        return array
        (
            'name'=>$this->getId(),
            'fullName'=>$this->getId(),
            'type'=>get_class($this)
        );
    }

    /**
     * @param bool $set
     * @return $this
     */
    public function trimValue($set = true)
    {
        $this->trimValue = $set;
        return $this;
    }

    /**
     * @return bool
     */
    public function shouldTrimValue()
    {
        return $this->trimValue;
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
     * @return mixed
     */
    public function getInputValue()
    {
        return $this->decodeValue($this->getValue());
    }
}