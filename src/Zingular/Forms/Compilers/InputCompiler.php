<?php

namespace Zingular\Forms\Compilers;
use Zingular\Forms\Component\ConvertableInterface;
use Zingular\Forms\Component\DataUnitComponentInterface;
use Zingular\Forms\Component\Elements\Controls\AbstractControl;
use Zingular\Forms\Component\FormState;
use Zingular\Forms\Component\RequiredInterface;
use Zingular\Forms\Exception\ComponentException;

/**
 * Class InputCompiler
 * @package Zingular\Forms\Compilers
 */
class InputCompiler
{
    // TODO: integrate with evaluation handler

    /**
     * @param AbstractControl $input
     * @param FormState $state
     * @param array $defaultValues
     * @throws ComponentException
     */
    public function compile(AbstractControl $input,FormState $state,array $defaultValues)
    {
        // manipulate default values
        $defaultValue = array_key_exists($input->getName(),$defaultValues) ? $defaultValues[$input->getName()] : null;

        // make sure the value is collected
        $this->retrieveValue($input,$state,$defaultValue);
    }

    /**
     * @param AbstractControl $input
     * @param FormState $state
     * @param mixed $defaultValue
     * @param array $evaluators
     * @throws ComponentException
     */
    public function retrieveValue(AbstractControl $input,FormState $state,$defaultValue = null)
    {
        // if there was a form scope default value provided, set that
        if(!is_null($defaultValue))
        {
            $input->setValue($defaultValue);
        }

        // if there was a submit
        if($this->shouldReadInput($input,$state))
        {
            // read the raw value
            $input->setValue($this->readInput($input,$state));

            // if there was no value from the input
            if($input->hasValue() === false)
            {
                $key = $input->getTranslationKey();

                // required check
                if($input instanceof RequiredInterface && $input->isRequired())
                {
                    $params = array('control'=>$state->getServices()->getTranslator()->translateRaw($key,$input,$state));
                    throw new ComponentException($input,'','validator.required',$params);
                }
            }
            // if there was a value from the input
            else
            {
                // evaluate the value
                $input->setValue($state->getServices()->getEvaluationHandler()->evaluate($input));

                // encode the value (if converter set)
                if($input instanceof ConvertableInterface)
                {
                    $config = $input->getConverter();

                    if(!is_null($config))
                    {
                        $converter = $state->getServices()->getConverters()->get($config->getType());

                        /** @var DataUnitComponentInterface $input */
                        $input->setValue($converter->encode($input->getValue(),$config->getArgs()));
                    }
                }

                // store the read input if it should be persisted
                if($input->isPersistent() || $state->isPersistent())
                {
                    $state->getServices()->getPersistenceHandler()->setValue($input->getFullName(),$input->getValue(),$state->getFormId());
                }
            }
        }
        // if input should not be read, get value from other source
        else
        {
            // if persistent and the persistence handler has a value for this data unit, load it
            if(($input->isPersistent() || $state->isPersistent()) && $state->getServices()->getPersistenceHandler()->hasValue($input->getFullName(),$state->getFormId()))
            {
                $input->setValue($state->getServices()->getPersistenceHandler()->getValue($input->getFullName(),$state->getFormId()));
            }
        }
    }

    /**
     * @param AbstractControl $input
     * @param FormState $state
     * @return bool
     */
    protected function shouldReadInput(AbstractControl $input,FormState $state)
    {
        return $state->hasSubmit() && !$input->hasFixedValue() && $state->hasInput($input->getFullName());
    }

    /**
     * @param AbstractControl $input
     * @param FormState $state
     * @return null|string
     */
    protected function readInput(AbstractControl $input,FormState $state)
    {
        // only load input value if it actually was set
        if($state->hasInput($input->getFullName()))
        {
            return $this->preprocessInputValue($input,$state->getInput($input->getFullName()));
        }

        return null;
    }

    /**
     * @param AbstractControl $input
     * @param $value
     * @return bool
     */
    protected function preprocessInputValue(AbstractControl $input,$value)
    {
        if(is_string($value))
        {
            // trim the raw value
            if($input->shouldTrimValue())
            {
                $value = trim($value);
            }

            // if the value is an empty string, and that is considered empty, return null
            if($input->emptyStringIsValue() === false && strlen($value) === 0)
            {
                return null;
            }

            return $value;
        }

        return null;
    }
}