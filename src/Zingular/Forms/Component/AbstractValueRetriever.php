<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 24-2-2016
 * Time: 20:15
 */

namespace Zingular\Forms\Component;

use Zingular\Forms\Exception\EvaluationException;
use Zingular\Forms\Service\Conversion\ConverterConfig;
use Zingular\Forms\Service\Conversion\ConverterInterface;
use Zingular\Forms\Service\Evaluation\EvaluatorConfigCollection;

abstract class AbstractValueRetriever
{
    /**
     * @var DataUnitInterface
     */
    protected $component;

    /**
     * @var ConverterInterface
     */
    protected $converter;

    /**
     * @var array
     */
    protected $converterArgs = array();

    /**
     * @var FormContext
     */
    protected $formContext;

    /**
     * @var EvaluatorConfigCollection
     */
    protected $evaluators;

    /**
     * @param DataUnitInterface $component
     * @param FormContext $context
     * @param EvaluatorConfigCollection $evaluators
     */
    public function __construct(DataUnitInterface $component,FormContext $context,EvaluatorConfigCollection $evaluators)
    {
        $this->component = $component;
        $this->formContext = $context;
        $this->evaluators = $evaluators;
    }

    /**
     * @param ConverterInterface $converter
     * @param ConverterConfig $config
     * @internal param ConverterConfig $config
     */
    public function setConverter(ConverterInterface $converter = null,ConverterConfig $config = null)
    {
        $this->converter = $converter;
        $this->converterArgs = is_null($config) ? array() : $config->getArgs();
    }

    /**
     * @param null $defaultValue
     * @return mixed|null|string
     * @throws EvaluationException
     */
    public function retrieveValue($defaultValue = null)
    {
        // start out with the current value of the component
        $value = $this->component->getValue();

        // start out with default value
        if(!is_null($defaultValue))
        {
            $value = $defaultValue;
        }

        // if there was a submit
        if($this->shouldReadInput($this->formContext))
        {
            // read the raw value
            $value = $this->readInput($this->formContext);

            // evaluate the value
            $value = $this->formContext->getServices()->getEvaluationHandler()->evaluate($value,$this->evaluators,$this->component);

            // encode the value (if converter set)
            $value = $this->encodeValue($value);

            // store the read input if it should be persisted
            if($this->component->isPersistent() || $this->formContext->isPersistent())
            {
                $this->formContext->getServices()->getPersistenceHandler()->setValue($this->component->getFullName(),$value,$this->formContext->getFormId());
            }
        }
        // if input should not be read, get value from other source
        else
        {
            // if persistent and the persistence handler has a value for this data unit, load it
            if(($this->component->isPersistent() || $this->formContext->isPersistent()) && $this->formContext->getServices()->getPersistenceHandler()->hasValue($this->component->getFullName(),$this->formContext->getFormId()))
            {
                $value = $this->formContext->getServices()->getPersistenceHandler()->getValue($this->component->getFullName(),$this->formContext->getFormId());
            }
        }

        return $value;
    }

    /**
     * @param FormContext $formContext
     * @return bool
     */
    protected function shouldReadInput(FormContext $formContext)
    {
        return $formContext->hasSubmit() && !$this->component->hasFixedValue();
    }

    /**
     * @param FormContext $formContext
     * @return null|string
     */
    protected function readInput(FormContext $formContext)
    {
        // only load input value if it actually was set
        if($formContext->hasInput($this->component->getFullName()))
        {
            return $this->preprocessInputValue($formContext->getInput($this->component->getFullName()));
        }
        return null;
    }

    /**
     * @param $value
     * @return bool
     */
    protected function preprocessInputValue($value)
    {
        return $value;
    }

    /***************************************************************
     * CONVERSION
     **************************************************************/

    /**
     * @param $value
     * @return mixed
     */
    protected function encodeValue($value)
    {
        if(isset($this->converter))
        {
            return $this->converter->encode($value,$this->converterArgs);
        }

        return $value;
    }
}