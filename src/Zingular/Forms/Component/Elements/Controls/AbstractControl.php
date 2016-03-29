<?php

namespace Zingular\Forms\Component\Elements\Controls;

use Zingular\Forms\Compilers\InputCompiler;
use Zingular\Forms\Component\ConvertableTrait;
use Zingular\Forms\Component\DataUnitComponentInterface;
use Zingular\Forms\Component\DescribableInterface;
use Zingular\Forms\Component\Elements\AbstractElement;
use Zingular\Forms\Component\EvaluatableInterface;
use Zingular\Forms\Component\EvaluatableTrait;
use Zingular\Forms\Component\FormState;
use Zingular\Forms\Component\CssComponentInterface;
use Zingular\Forms\Component\RequiredInterface;
use Zingular\Forms\Component\RequiredTrait;
use Zingular\Forms\Events\ComponentEvent;
use Zingular\Forms\Exception\ComponentException;
use Zingular\Forms\Exception\FormException;
use Zingular\Forms\Service\Conversion\ConverterConfig;
use Zingular\Forms\Service\Evaluation\FilterConfig;
use Zingular\Forms\Service\Evaluation\ValidatorConfig;
use Zingular\Forms\Service\ServiceConsumerTrait;


/**
 * Class AbstractControl
 * @package Zingular\Form
 */
abstract class AbstractControl extends AbstractElement implements
    EvaluatableInterface,
    RequiredInterface,
    CssComponentInterface,
    DescribableInterface
{
    use RequiredTrait;
    use ServiceConsumerTrait;
    use ConvertableTrait;
    use EvaluatableTrait;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var mixed
     */
    protected $inputValue;

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
     * @var bool
     */
    protected $trimValue = true;

    /**
     * @var bool
     */
    protected $emptyStringIsValue = false;

    /**
     * @var InputCompiler
     */
    protected $compiler;

    /**
     * @param FormState $state
     * @param array $defaultValues
     * @return string
     */
    public function compile(FormState $state,array $defaultValues = array())
    {
        $this->compiler = new InputCompiler();

        $this->compiler->compile($this,$state,$defaultValues);

        // dispatchEvent event
        $event = new ComponentEvent(ComponentEvent::COMPILED,$this);
        $this->dispatchEvent($event);
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
            'type'=>get_class($this),
            'value'=>$this->value
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
     * @throws ComponentException
     */
    public function getInputValue()
    {
        if(is_null($this->compiler))
        {
            throw new ComponentException($this,sprintf("Cannot retrieve input value for component '%s': not compiled yet!",$this->getFullId()));
        }

        if(!is_null($this->converterConfig))
        {
            $converter = $this->state->getServices()->getConverters()->get($this->converterConfig->getType());

            return $converter->decode($this->getValue());
        }

        return $this->getValue();
    }

    /***************************************************************
     * NAME
     **************************************************************/

    /**
     * @return string
     */
    public function getName()
    {
        return $this->context->getName();
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->context->getFullName();
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->context->setName($name);
        return $this;
    }
}