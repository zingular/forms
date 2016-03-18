<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 30-1-2016
 * Time: 14:55
 */

namespace Zingular\Forms\Component\Containers;
use Zingular\Forms\Component\Context;
use Zingular\Forms\Component\Elements\Contents\Content;
use Zingular\Forms\Component\Elements\Contents\Html;
use Zingular\Forms\Component\Elements\Contents\HtmlTag;
use Zingular\Forms\Component\Elements\Contents\Label;
use Zingular\Forms\Component\Elements\Contents\View;
use Zingular\Forms\Component\Elements\Controls\Button;
use Zingular\Forms\Component\Elements\Controls\Checkbox;
use Zingular\Forms\Component\Elements\Controls\Hidden;
use Zingular\Forms\Component\Elements\Controls\Input;
use Zingular\Forms\Component\Elements\Controls\Select;
use Zingular\Forms\Component\Elements\Controls\Textarea;
use Zingular\Forms\Component\FormState;
use Zingular\Forms\Events\FormEvent;
use Zingular\Forms\Exception\InvalidArgumentException;
use Zingular\Forms\FormContext;
use Zingular\Forms\Service\ServiceDefinerInterface;
use Zingular\Forms\Exception\FormException;
use Zingular\Forms\Plugins\Builders\Prototype\PrototypeBuilderInterface;
use Zingular\Forms\Service\ServiceDefinerTrait;
use Zingular\Forms\Service\ServicesInterface;

/**
 * Class Form
 * @package Zingular\Form
 */
class Form extends Container implements
    PrototypesInterface,
    ServiceDefinerInterface,
    FormInterface
{
    use ServiceDefinerTrait;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $method = 'post';

    /**
     * @var string
     */
    protected $action;

    /**
     * @var bool
     */
    protected $compiled = false;

    /**
     * @var bool
     */
    protected $persistent = false;

    /**
     * @var array
     */
    protected $defaultValues = array();

    /**
     * @var object
     */
    protected $model;

    /**
     * @param Context $context
     * @throws FormException
     */
    public function setContext(Context $context)
    {
        parent::setContext($context);

        if(!($context instanceof FormContext))
        {
            throw new FormException("Cannot set form context: context for form should be instance of FormContext!");
        }

        $this->services = $context->getServices();
    }

    /**
     * @param $model
     * @throws FormException
     */
    public function setModel($model)
    {
        // if form is already compiling
        if(!is_null($this->state))
        {
            throw new FormException("Cannot set ORM-model: form already compiling!",'orm.tooLateToSetModel');
        }

        // model should be object
        if(!is_object($model))
        {
            throw new FormException(sprintf("Cannot set ORM-model: invalid model type!",gettype($model)),'orm.invalidModelType',array(gettype($model)));
        }

        // store the model
        $this->model = $model;

        // extract and set the default values
        $this->setDefaultValues($this->services->getOrmHandler()->extractValues($model));
    }

    /**
     * @return bool
     */
    public function hasSubmit()
    {
        // TODO: do csrf check here?


        return $this->getFormState()->getInput('FORM_SUBMITTED') === $this->getId();
    }

    /**********************************************************************
     * METHOD
     *********************************************************************/

    /**
     * @param string $method
     * @throws FormException
     */
    public function setHttpMethod($method = self::GET)
    {
        // normalize the method
        $method = strtolower($method);

        // check the method
        if(!in_array($method,array(self::GET,self::POST)))
        {
            throw new InvalidArgumentException(sprintf("Invalid form method: '%s', should be either 'get' or 'post'!",$method),'httpMethod',array('method'=>$method));
        }

        $this->method = $method;
    }

    /**
     * @return string
     */
    public function getHttpMethod()
    {
        return $this->method;
    }

    /**********************************************************************
     * ACTION
     *********************************************************************/

    /**
     * @param $action
     */
    public function setAction($action = null)
    {
        $this->action = $action;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**********************************************************************
     * PERSISTENCE
     *********************************************************************/

    /**
     * @param bool $set
     */
    public function persistent($set = true)
    {
        $this->persistent = $set;
    }

    /**
     * @return bool
     */
    public function isPersistent()
    {
        return $this->persistent;
    }

    /**********************************************************************
     * DEFAULT VALUES
     *********************************************************************/

    /**
     * @param string $name
     * @param mixed $value
     */
    public function setDefaultValue($name,$value)
    {
        $this->defaultValues[$name] = $value;
    }

    /**
     * @param array $values
     */
    public function setDefaultValues(array $values = array())
    {
        $this->defaultValues = $values;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getValue($name)
    {
        return $this->state->getValue($name);
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return $this->state->getValues();
    }

    /**********************************************************************
     * COMPILING
     *********************************************************************/

    /**
     * @param FormState $state
     * @param array $defaultValues
     */
    public function compile(FormState $state,array $defaultValues = array())
    {
        // prevent multiple compiles
        if($this->compiled === false)
        {
            $this->compiled = true;
            parent::compile($state,$defaultValues);

            // if form was successful
            if($this->valid())
            {
                // handle the orm model, if any
                if(!is_null($this->model))
                {
                    $this->getOrmHandler()->setValues($this->getValues(),$this->model);
                }

                // handle handlers
                // TODO


                // dispatch event
                $event = new FormEvent(FormEvent::VALID,$this);
                $this->dispatch($event);
            }
        }
    }


    /**
     * @return string
     */
    public function render()
    {
        // compile this form
        $this->compile($this->getFormState(),$this->defaultValues);

        // return the rendered view
        return $this->getViewHandler()->render($this);
    }

    /**
     * @param FormState $state
     */
    protected function preBuild(FormState $state)
    {
        // add form submitted hidden field
        $this->addHidden('FORM_SUBMITTED')
            ->setValue($this->getId())
            ->ignoreValue();

        // add csrf validation field
        $handler = $this->getCsrfHandler();

        // add csrf field
        $this->addHidden($handler->generateTokenFieldname($handler->generateToken($this->getId()),$this->getId()))
            ->ignoreValue();
    }

    /**
     * @return bool
     */
    public function valid()
    {
        // TODO: csrf check?

        // TODO: check if there were errors
        return true;
    }

    /**********************************************************************
     * INTERNAL
     *********************************************************************/

    /**
     * @return FormState
     */
    protected function getFormState()
    {
        if(is_null($this->state))
        {
            $this->state = new FormState($this,$this->getServices());
        }

        return $this->state;
    }

    /**
     * @return ServicesInterface
     */
    protected function getServices()
    {
        return $this->services;
    }

    /**********************************************************************
     * PROTOTYPE DEFINERS
     *********************************************************************/

    /**
     * @param PrototypeBuilderInterface $builder
     */
    public function addPrototypes(PrototypeBuilderInterface $builder)
    {
        $builder->buildPrototypes($this->context->getPrototypes());
    }

    /**
     * @param $name
     * @return Content
     */
    public function defineContent($name)
    {
        return $this->context->getPrototypes()->defineContent($name);
    }

    /**
     * @param $name
     * @return Label
     */
    public function defineLabel($name)
    {
        return $this->context->getPrototypes()->defineLabel($name);
    }

    /**
     * @param $name
     * @return Html
     */
    public function defineHtml($name)
    {
        return $this->context->getPrototypes()->defineHtml($name);
    }

    /**
     * @param $name
     * @return HtmlTag
     */
    public function defineHtmlTag($name)
    {
        return $this->context->getPrototypes()->defineHtmlTag($name);
    }

    /**
     * @param $name
     * @return View
     */
    public function defineView($name)
    {
        return $this->context->getPrototypes()->defineView($name);
    }

    /**
     * @param $name
     * @return Input
     */
    public function defineInput($name)
    {
        return $this->context->getPrototypes()->defineInput($name);
    }

    /**
     * @param $name
     * @return Checkbox
     */
    public function defineCheckbox($name)
    {
        return $this->context->getPrototypes()->defineCheckbox($name);
    }

    /**
     * @param $name
     * @return Hidden
     */
    public function defineHidden($name)
    {
        return $this->context->getPrototypes()->defineHidden($name);
    }

    /**
     * @param $name
     * @return Select
     */
    public function defineSelect($name)
    {
        return $this->context->getPrototypes()->defineSelect($name);
    }

    /**
     * @param $name
     * @return Textarea
     */
    public function defineTextarea($name)
    {
        return $this->context->getPrototypes()->defineTextarea($name);
    }

    /**
     * @param $name
     * @return Button
     */
    public function defineButton($name)
    {
        return $this->context->getPrototypes()->defineButton($name);
    }

    /**
     * @param $name
     * @return Container
     */
    public function defineContainer($name)
    {
        return $this->context->getPrototypes()->defineContainer($name);
    }

    /**
     * @param $name
     * @return Field
     */
    public function defineField($name)
    {
        return $this->context->getPrototypes()->defineField($name);
    }

    /**
     * @param $name
     * @return Fieldset
     */
    public function defineFieldset($name)
    {
        return $this->context->getPrototypes()->defineFieldset($name);
    }

    /**
     * @param $name
     * @return Aggregator
     */
    public function defineAggregator($name)
    {
        return $this->context->getPrototypes()->defineAggregator($name);
    }


    /**
     * @param $name
     * @return Row
     */
    public function defineRow($name)
    {
        return $this->context->getPrototypes()->defineRow($name);
    }

    /**
     * @param $parentName
     * @param $name
     * @return Input
     */
    public function extendInput($parentName, $name)
    {
        return $this->context->getPrototypes()->extendInput($parentName,$name);
    }

    /**
     * @param $parentName
     * @param $name
     * @return Checkbox
     */
    public function extendCheckbox($parentName, $name)
    {
        return $this->context->getPrototypes()->extendCheckbox($parentName,$name);
    }

    /**
     * @param $parentName
     * @param $name
     * @return Select
     */
    public function extendSelect($parentName, $name)
    {
        return $this->context->getPrototypes()->extendSelect($parentName,$name);
    }

    /**
     * @param $parentName
     * @param $name
     * @return Textarea
     */
    public function extendTextarea($parentName, $name)
    {
        return $this->context->getPrototypes()->extendTextarea($parentName,$name);
    }

    /**
     * @param $parentName
     * @param $name
     * @return Button
     * @throws FormException
     */
    public function extendButton($parentName, $name)
    {
        return $this->context->getPrototypes()->extendButton($parentName,$name);
    }

    /**
     * @param $parentName
     * @param $name
     * @return Container
     * @throws FormException
     */
    public function extendContainer($parentName, $name)
    {
        return $this->context->getPrototypes()->extendContainer($parentName,$name);
    }

    /**
     * @param $parentName
     * @param $name
     * @return Aggregator
     * @throws FormException
     */
    public function extendAggregator($parentName, $name)
    {
        return $this->context->getPrototypes()->extendAggregator($parentName,$name);
    }

    /**
     * @param $parentName
     * @param $name
     * @return Container
     * @throws FormException
     */
    public function extendFieldset($parentName, $name)
    {
        return $this->context->getPrototypes()->extendFieldset($parentName,$name);
    }

    /**
     * @param $parentName
     * @param $name
     * @return Container
     * @throws FormException
     */
    public function extendField($parentName, $name)
    {
        return $this->context->getPrototypes()->extendField($parentName,$name);
    }

    /**
     * @param $parentName
     * @param $name
     * @return Row
     * @throws FormException
     */
    public function extendRow($parentName, $name)
    {
        return $this->context->getPrototypes()->extendRow($parentName,$name);
    }

    /**
     * @return Label
     */
    public function getLabelPrototype()
    {
        return $this->context->getPrototypes()->getLabelPrototype();
    }

    /**
     * @return Content
     */
    public function getContentPrototype()
    {
        return $this->context->getPrototypes()->getContentPrototype();
    }

    /**
     * @return Html
     */
    public function getHtmlPrototype()
    {
        return $this->context->getPrototypes()->getHtmlPrototype();
    }

    /**
     * @return HtmlTag
     */
    public function getHtmlTagPrototype()
    {
        return $this->context->getPrototypes()->getHtmlTagPrototype();
    }

    /**
     * @return View
     */
    public function getViewPrototype()
    {
        return $this->context->getPrototypes()->getViewPrototype();
    }

    /**
     * @return Input
     */
    public function getInputPrototype()
    {
        return $this->context->getPrototypes()->getInputPrototype();
    }

    /**
     * @return Hidden
     */
    public function getHiddenPrototype()
    {
        return $this->context->getPrototypes()->getHiddenPrototype();
    }

    /**
     * @return Select
     */
    public function getSelectPrototype()
    {
        return $this->context->getPrototypes()->getSelectPrototype();
    }

    /**
     * @return Button
     */
    public function getButtonPrototype()
    {
        return $this->context->getPrototypes()->getButtonPrototype();
    }

    /**
     * @return Checkbox
     */
    public function getCheckboxPrototype()
    {
        return $this->context->getPrototypes()->getCheckboxPrototype();
    }

    /**
     * @return Textarea
     */
    public function getTextareaPrototype()
    {
        return $this->context->getPrototypes()->getTextareaPrototype();
    }

    /**
     * @return Container
     */
    public function getContainerPrototype()
    {
        return $this->context->getPrototypes()->getContainerPrototype();
    }

    /**
     * @return Field
     */
    public function getFieldPrototype()
    {
        return $this->context->getPrototypes()->getFieldPrototype();
    }

    /**
     * @return Fieldset
     */
    public function getFieldsetPrototype()
    {
        return $this->context->getPrototypes()->getFieldsetPrototype();
    }

    /**
     * @return Aggregator
     */
    public function getAggregatorPrototype()
    {
        return $this->context->getPrototypes()->getAggregatorPrototype();
    }

    /**
     * @return Row
     */
    public function getRowPrototype()
    {
        return $this->context->getPrototypes()->getRowPrototype();
    }

    /**
     * @return Form
     */
    public function getFormPrototype()
    {
        return $this->context->getPrototypes()->getFormPrototype();
    }

    /***************************************************************
     * GETTERS
     **************************************************************/

    /**
     * @param $name
     * @return Input
     * @throws FormException
     */
    public function getDefinedInput($name)
    {
        return $this->context->getPrototypes()->getDefinedInput($name);
    }

    /**
     * @param $name
     * @return Checkbox
     * @throws FormException
     */
    public function getDefinedCheckbox($name)
    {
        return $this->context->getPrototypes()->getDefinedCheckbox($name);
    }

    /**
     * @param $name
     * @return Select
     * @throws FormException
     */
    public function getDefinedSelect($name)
    {
        return $this->context->getPrototypes()->getDefinedSelect($name);
    }

    /**
     * @param $name
     * @return Textarea
     * @throws FormException
     */
    public function getDefinedTextarea($name)
    {
        return $this->context->getPrototypes()->getDefinedTextarea($name);
    }

    /**
     * @param $name
     * @return Button
     * @throws FormException
     */
    public function getDefinedButton($name)
    {
        return $this->context->getPrototypes()->getDefinedButton($name);
    }

    /**
     * @param $name
     * @return Container
     * @throws FormException
     */
    public function getDefinedContainer($name)
    {
        return $this->context->getPrototypes()->getDefinedContainer($name);
    }

    /**
     * @param $name
     * @return Aggregator
     * @throws FormException
     */
    public function getDefinedAggregator($name)
    {
        return $this->context->getPrototypes()->getDefinedAggregator($name);
    }

    /**
     * @param $name
     * @return Container
     * @throws FormException
     */
    public function getDefinedFieldset($name)
    {
        return $this->context->getPrototypes()->getDefinedFieldset($name);
    }

    /**
     * @param $name
     * @return Container
     * @throws FormException
     */
    public function getDefinedField($name)
    {
        return $this->context->getPrototypes()->getDefinedFieldset($name);
    }

    /**
     * @param $name
     * @return Row
     * @throws FormException
     */
    public function getDefinedRow($name)
    {
        return $this->context->getPrototypes()->getDefinedRow($name);
    }
}