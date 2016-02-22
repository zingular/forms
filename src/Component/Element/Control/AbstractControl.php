<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 30-1-2016
 * Time: 16:39
 */

namespace Zingular\Form\Component\Element\Control;
use Zingular\Form\Component\ComponentTrait;
use Zingular\Form\Component\DataUnitInterface;
use Zingular\Form\Component\DataUnitTrait;
use Zingular\Form\Component\Element\AbstractElement;
use Zingular\Form\Component\FormContext;
use Zingular\Form\Component\RequiredTrait;


/**
 * Class AbstractControl
 * @package Zingular\Form
 */
abstract class AbstractControl extends AbstractElement implements DataUnitInterface
{
    use ComponentTrait;
    use RequiredTrait;
    use DataUnitTrait;

    /**
     * @var bool
     */
    protected $trimValue = true;

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
        $this->retrieveValue($formContext,$defaultValue);
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
}