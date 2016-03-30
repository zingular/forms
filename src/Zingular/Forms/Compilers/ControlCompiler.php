<?php

namespace Zingular\Forms\Compilers;
use Zingular\Forms\Component\ConvertableInterface;
use Zingular\Forms\Component\DataUnitComponentInterface;
use Zingular\Forms\Component\Elements\Controls\AbstractControl;
use Zingular\Forms\Component\EvaluatableInterface;
use Zingular\Forms\Component\FormState;
use Zingular\Forms\Component\RequiredInterface;
use Zingular\Forms\Component\TranslatableComponentInterface;
use Zingular\Forms\Exception\ComponentException;

/**
 * Class ControlCompiler
 * @package Zingular\Forms\Compilers
 */
class ControlCompiler
{
    // TODO: integrate with evaluation handler



    /**
     * @param DataUnitComponentInterface $input
     * @param FormState $state
     * @param array $defaultValues
     * @throws ComponentException
     */
    public function compile(DataUnitComponentInterface $input,FormState $state,array $defaultValues)
    {
        // extract the input name
        $name = $input->getName();
        $fullName = $input->getFullName();

        // if there was a form scope default value provided, set that
        if(array_key_exists($name,$defaultValues) && !is_null($defaultValues[$name]))
        {
            $input->setValue($defaultValues[$name]);
        }

        // if there was a submit
        if($this->shouldReadInput($input,$state))
        {
            // read the raw value
            $input->setValue($this->readInput($input,$state));

            // if there was no value from the input
            if($input->hasValue() === false)
            {
                // required check
                if($input instanceof RequiredInterface && $input->isRequired())
                {
                    $params = array();

                    if($input instanceof TranslatableComponentInterface)
                    {
                        $key = $input->getTranslationKey();
                        $params = array('control'=>$state->getServices()->getTranslator()->translateRaw($key,$input,$state));
                    }

                    throw new ComponentException($input,'','validator.required',$params);
                }
            }
            // if there was a value from the input
            else
            {
                // evaluate the value
                if($input instanceof EvaluatableInterface)
                {
                    $input->setValue($state->getServices()->getEvaluationHandler()->evaluate($input));
                }

                // encode the value (if converter set)
                if($input instanceof ConvertableInterface)
                {
                    // extract the converter config from the input
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
                    $state->getServices()->getPersistenceHandler()->setValue($fullName,$input->getValue(),$state->getFormId());
                }
            }
        }
        // if input should not be read, get value from other source
        else
        {
            // if persistent and the persistence handler has a value for this data unit, load it
            if(($input->isPersistent() || $state->isPersistent()) && $state->getServices()->getPersistenceHandler()->hasValue($fullName,$state->getFormId()))
            {
                $input->setValue($state->getServices()->getPersistenceHandler()->getValue($fullName,$state->getFormId()));
            }
        }
    }

    /**
     * @param DataUnitComponentInterface $input
     * @param FormState $state
     * @return bool
     */
    protected function shouldReadInput(DataUnitComponentInterface $input,FormState $state)
    {
        return $state->hasSubmit() && !$input->hasFixedValue() && $state->hasInput($input->getFullName());
    }

    /**
     * @param DataUnitComponentInterface $input
     * @param FormState $state
     * @return null|string
     */
    protected function readInput(DataUnitComponentInterface $input,FormState $state)
    {
        // only load input value if it actually was set
        if($state->hasInput($input->getFullName()))
        {
            return $this->preprocessInputValue($input,$state->getInput($input->getFullName()));
        }

        return null;
    }

    /**
     * @param DataUnitComponentInterface $input
     * @param $value
     * @return bool
     */
    protected function preprocessInputValue(DataUnitComponentInterface $input,$value)
    {
        // TODO: decide what interface to put this in
        if($input instanceof AbstractControl)
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
        }

        return null;
    }
}