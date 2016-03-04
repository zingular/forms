<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 30-1-2016
 * Time: 16:39
 */

namespace Zingular\Forms\Component\Element\Control;
use Zingular\Forms\Component\DataUnitInterface;
use Zingular\Forms\Component\DataUnitTrait;
use Zingular\Forms\Component\Element\AbstractElement;
use Zingular\Forms\Component\FormContext;
use Zingular\Forms\Component\RequiredTrait;
use Zingular\Forms\Exception\EvaluationException;
use Zingular\Forms\Exception\ValidationException;
use Zingular\Forms\Service\Conversion\ConverterConfig;
use Zingular\Forms\Service\Conversion\ConverterInterface;

/**
 * Class AbstractControl
 * @package Zingular\Form
 */
abstract class AbstractControl extends AbstractElement implements DataUnitInterface
{
    use RequiredTrait;
    use DataUnitTrait;

    /**
     * @var bool
     */
    protected $trimValue = true;


    /**
     * @var ConverterConfig
     */
    protected $converterConfig;

    /**
     * @var bool
     */
    protected $emptyStringIsValue = false;


    /**
     * @param FormContext $formContext
     * @param array $defaultValues
     * @return string
     */
    public function compile(FormContext $formContext,array $defaultValues = array())
    {
        // set the form context locally
        $this->formContext = $formContext;

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
        if($this->shouldReadInput($this->formContext))
        {
            // read the raw value
            $this->value = $this->readInput($this->formContext);

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
     * @param FormContext $formContext
     * @return null|string
     */
    protected function readInput(FormContext $formContext)
    {
        // only load input value if it actually was set
        if($formContext->hasInput($this->getFullName()))
        {
            return $this->preprocessInputValue($formContext->getInput($this->getFullName()));
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
     * @param $converter
     * @param $params
     * @return $this
     */
    public function setConverter($converter,...$params)
    {
        $this->converterConfig = new ConverterConfig($converter,$params);
    }

    /**
     * @return ConverterInterface
     */
    protected function getConverter()
    {
        if(!is_null($this->converterConfig))
        {
            return $this->getServices()->getConverters()->get($this->converterConfig->getType());
        }

        return null;
    }



    /**
     * @param $value
     * @return mixed
     */
    protected function decodeValue($value)
    {
        if(!is_null($this->getConverter()))
        {
            return $this->getConverter()->decode($value,$this->converterConfig->getArgs());
        }

        return $value;
    }


    /**
     * @param $value
     * @return mixed
     */
    protected function encodeValue($value)
    {
        if(isset($this->converter))
        {
            return $this->converter->encode($value,$this->converterConfig->getArgs());
        }

        return $value;
    }

    /**
     * @return mixed
     */
    public function getInputValue()
    {
        return $this->decodeValue($this->getValue());
    }
}