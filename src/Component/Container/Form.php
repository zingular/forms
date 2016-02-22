<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 30-1-2016
 * Time: 14:55
 */

namespace Zingular\Form\Component\Container;
use Zingular\Form\BaseTypes;
use Zingular\Form\Component\Context;
use Zingular\Form\Component\Element\Content\Content;
use Zingular\Form\Component\Element\Content\Html;
use Zingular\Form\Component\Element\Content\HtmlTag;
use Zingular\Form\Component\Element\Content\Label;
use Zingular\Form\Component\Element\Content\View;
use Zingular\Form\Component\Element\Control\Button;
use Zingular\Form\Component\Element\Control\Checkbox;
use Zingular\Form\Component\Element\Control\Hidden;
use Zingular\Form\Component\Element\Control\Input;
use Zingular\Form\Component\Element\Control\Select;
use Zingular\Form\Component\Element\Control\Textarea;
use Zingular\Form\Component\FormContext;
use Zingular\Form\Component\ServiceSetterTrait;
use Zingular\Form\Exception\FormException;
use Zingular\Form\Method;
use Zingular\Form\Service\Services;
use Zingular\Form\View as ViewConstants;

/**
 * Class Form
 * @package Zingular\Form
 */
class Form extends Container implements PrototypeDefinerInterface
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
     * @var FormContext
     */
    protected $formContext;

    /**
     * @var bool
     */
    protected $compiled = false;

    /**
     * @var string
     */
    protected $cssBaseTypeClass = 'form';

    /**
     * @var string
     */
    protected $viewName = ViewConstants::FORM;

    /**
     * @var string
     */
    protected $baseType = BaseTypes::FORM;

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
     * @param Services $services
     * @param Prototypes $prototypes
     * @param object $model
     */
    public function __construct($id,Services $services,Prototypes $prototypes,$model = null)
    {
        $this->services = $services;
        $this->setContext(new Context($id,null,$prototypes)); // manually set context (without parent)

        // TEST ORM
        if(is_object($model))
        {
            $this->setDefaultValues($services->getOrmHandler()->extractDefaultValues($model));
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
    public function setMethod($method = Method::GET)
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
    public function getMethod()
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

    /**********************************************************************
     * COMPILING
     *********************************************************************/

    /**
     * @param FormContext $formContext
     * @param array $defaultValues
     */
    public function compile(FormContext $formContext,array $defaultValues = array())
    {
        // prevent multiple compiles
        if($this->compiled === false)
        {
            $this->compiled = true;
            parent::compile($formContext,$defaultValues);

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
     *
     */
    protected function preBuild()
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
        return $this->getServices()->getViewHandler()->render($this,$this->getServices()->getTranslator());
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
     * @return FormContext
     */
    protected function getFormContext()
    {
        if(is_null($this->formContext))
        {
            $this->formContext = new FormContext($this,$this->getServices());
        }

        return $this->formContext;
    }

    /**
     * @return Services
     */
    protected function getServices()
    {
        return $this->services;
    }

    /**********************************************************************
     * PROTOTYPE DEFINERS
     *********************************************************************/

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
}