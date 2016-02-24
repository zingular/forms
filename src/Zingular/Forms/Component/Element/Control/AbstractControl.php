<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 30-1-2016
 * Time: 16:39
 */

namespace Zingular\Forms\Component\Element\Control;
use Zingular\Forms\Component\ControlValueRetriever;
use Zingular\Forms\Component\DataUnitInterface;
use Zingular\Forms\Component\DataUnitTrait;
use Zingular\Forms\Component\Element\AbstractElement;
use Zingular\Forms\Component\FormContext;
use Zingular\Forms\Component\RequiredTrait;
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
        $retriever = new ControlValueRetriever($this,$formContext,$this->getEvaluatorCollection());
        $retriever->setConverter($this->getConverter(),$this->converterConfig);

        $this->value = $retriever->retrieveValue($defaultValue);
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
            return $this->processInputValue($formContext->getInput($this->getFullName()));
        }
        return null;
    }

    /**
     * @param $value
     * @return bool
     */
    protected function processInputValue($value)
    {
        // if the value is null, return that
        if(is_null($value))
        {
            return null;
        }
        // if the value is an empty string, and that is considered empty, return null
        elseif(!$this->emptyStringIsValue && (is_string($value) && strlen($value) === 0))
        {
            return null;
        }

        // trim the raw value
        if($this->trimValue && is_string($value))
        {
            $value = trim($value);
        }

        return $value;
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
            return $this->formContext->getServices()->getConverters()->get($this->converterConfig->getType());
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
     * @return mixed
     */
    public function getInputValue()
    {
        return $this->decodeValue($this->getValue());
    }
}