<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 30-1-2016
 * Time: 14:55
 */

namespace Zingular\Forms\Component\Container;
use Zingular\Forms\Component\Context;
use Zingular\Forms\Component\Element\Content\Content;
use Zingular\Forms\Component\Element\Content\Html;
use Zingular\Forms\Component\Element\Content\HtmlTag;
use Zingular\Forms\Component\Element\Content\Label;
use Zingular\Forms\Component\Element\Content\View;
use Zingular\Forms\Component\Element\Control\Button;
use Zingular\Forms\Component\Element\Control\Checkbox;
use Zingular\Forms\Component\Element\Control\Hidden;
use Zingular\Forms\Component\Element\Control\Input;
use Zingular\Forms\Component\Element\Control\Select;
use Zingular\Forms\Component\Element\Control\Textarea;
use Zingular\Forms\Component\FormState;
use Zingular\Forms\Component\ServiceSetterInterface;
use Zingular\Forms\Component\ServiceSetterTrait;
use Zingular\Forms\Component\ServicesInterface;
use Zingular\Forms\Exception\FormException;
use Zingular\Forms\Method;
use Zingular\Forms\Service\Builder\Prototypes\PrototypeBuilderInterface;

/**
 * Class Form
 * @package Zingular\Form
 */
class Form extends Container implements PrototypesInterface,ServiceSetterInterface
{
    use ServiceSetterTrait;

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
     * @param Prototypes $id
     * @param ServicesInterface $services
     * @param Prototypes $prototypes
     * @param object $model
     */
    public function __construct($id,ServicesInterface $services,Prototypes $prototypes,$model = null)
    {
        // store the services
        $this->services = $services;

        // manually set context (without parent)
        $this->setContext(new Context($id,null,$prototypes));

        // TEST ORM
        if(is_object($model))
        {
            $this->setDefaultValues($services->getOrmHandler()->extractValues($model));
            $this->model = $model;
        }
    }

    /**
     * @return bool
     */
    public function hasSubmit()
    {
        return $this->getFormContext()->getInput('FORM_SUBMITTED') === $this->getId();
    }

    /**********************************************************************
     * METHOD
     *********************************************************************/

    /**
     * @param string $method
     * @throws FormException
     */
    public function setHttpMethod($method = Method::GET)
    {
        // normalize the method
        $method = strtolower($method);

        // check the method
        if(!in_array($method,array(Method::GET,Method::POST)))
        {
            throw new FormException(sprintf("Invalid form method: '%s'",$method));
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
                    $this->getServices()->getOrmHandler()->setValues($this->getValues(),$this->model);
                }

                // handle handlers
                // TODO
            }
        }
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
        $handler = $this->getServices()->getCsrfHandler();

        // add csrf field
        $this->addHidden($handler->generateTokenFieldname($handler->generateToken($this->getId()),$this->getId()))
            ->ignoreValue();
    }

    /**
     * @return string
     */
    public function render()
    {
        // TEST CONDITIONS
        /*
        $pool = $this->getServices()->getConditions();
        $pool->add(new CallableCondition('myCondition',function(ComponentInterface $component){return !is_null($component);},true));
        var_dump($pool->validate('myCondition',$this,array(),$this->getFormContext()));
        */

        // compile this form
        $this->compile($this->getFormContext(),$this->defaultValues);

        // return the rendered view
        return $this->getServices()->getViewHandler()->render($this);
    }

    /**
     *
     */
    public function valid()
    {
        // TODO: check if there were errors
        return true;
    }

    /**********************************************************************
     * INTERNAL
     *********************************************************************/

    /**
     * @return FormState
     */
    protected function getFormContext()
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

}