<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 7-2-2016
 * Time: 11:43
 */

namespace Zingular\Forms\Component\Containers;
use Zingular\Forms\BaseTypes;
use Zingular\Forms\Component\ComponentInterface;
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
use Zingular\Forms\Component\CssComponentInterface;
use Zingular\Forms\Component\TypedComponentInterface;
use Zingular\Forms\Exception\FormException;

use Zingular\Forms\Service\Component\ComponentFactoryInterface;

/**
 * Class Prototypes
 * @package Zingular\Form\Component\Container
 */
class Prototypes extends AbstractContainer implements PrototypesInterface
{
    /**
     * @var array
     */
    protected $prototypes;

    /**
     * @var ComponentFactoryInterface
     */
    protected $componentFactory;

    /**
     * @param ComponentFactoryInterface $factory
     */
    public function __construct(ComponentFactoryInterface $factory)
    {
        $this->componentFactory = $factory;
    }

    /**
     * @param $name
     * @param ComponentInterface $component
     * @param int|string $position
     * @return ComponentInterface
     * @throws FormException
     */
    protected function adopt($name,ComponentInterface $component,$position = -1)
    {
        // add using parent method
        $component = parent::adopt($name,$component,$position);

        // add a type css class
        if($component instanceof CssComponentInterface)
        {
            $component->setCssTypeClass($name);
        }

        // set the name as type
        if($component instanceof TypedComponentInterface)
        {
            $component->setType($name);
        }

        // also set the css type class
        return $component;
    }

    /**
     * @param string $baseType
     * @return ComponentInterface
     */
    protected function getPrototype($baseType)
    {
        if(!isset($this->prototypes[$baseType]))
        {
            $this->prototypes[$baseType] = $this->createPrototype($baseType);
        }

        return $this->prototypes[$baseType];
    }

    /**
     * @param $baseType
     * @return mixed
     * @throws FormException
     */
    protected function createPrototype($baseType)
    {
        switch($baseType)
        {
            case BaseTypes::AGGREGATOR: return $this->componentFactory->createAggregator();
            case BaseTypes::FIELD: return $this->componentFactory->createField();
            case BaseTypes::FIELDSET: return $this->componentFactory->createFieldset();
            case BaseTypes::ROW: return $this->componentFactory->createRow();
            case BaseTypes::BUTTON: return $this->componentFactory->createButton();
            case BaseTypes::CONTAINER: return $this->componentFactory->createContainer();
            case BaseTypes::CONTENT: return $this->componentFactory->createContent();
            case BaseTypes::HTML: return $this->componentFactory->createHtml();
            case BaseTypes::HTMLTAG: return $this->componentFactory->createHtmlTag();
            case BaseTypes::LABEL: return $this->componentFactory->createLabel();
            case BaseTypes::VIEW: return $this->componentFactory->createView();
            case BaseTypes::CHECKBOX: return $this->componentFactory->createCheckbox();
            case BaseTypes::INPUT: return $this->componentFactory->createInput();
            case BaseTypes::HIDDEN: return $this->componentFactory->createHidden();
            case BaseTypes::SELECT: return $this->componentFactory->createSelect();
            case BaseTypes::TEXTAREA: return $this->componentFactory->createTextarea();
            case BaseTypes::FORM: return $this->componentFactory->createForm();
        }

        throw new FormException(sprintf("Cannot create form component: unknown component base type '%s'",$baseType));
    }

    /**
     * @param $baseType
     * @param $baseClass
     * @param null $prototype
     * @return ComponentInterface
     * @throws FormException
     */
    public function export($baseType,$baseClass,$prototype = null)
    {
        // if there is no specific prototype specified, return the prototype for the base type
        if(is_null($prototype))
        {
            return $this->exportPrototype($baseType);
        }

        // if there is a protoype specified, it should exist
        if(!$this->hasComponent($prototype,$baseClass))
        {
            throw new FormException(sprintf("Cannot export prototype '%s': no such prototype or base class is not '%s'!",$prototype,$baseClass));
        }

        // if it exists, return a clone
        return $this->cloneComponent($prototype);
    }

    /**
     * @param $baseType
     * @return ComponentInterface
     */
    public function exportPrototype($baseType)
    {
        return clone $this->getPrototype($baseType);
    }

    /**
     * @return Form
     */
    public function exportFormPrototype()
    {
       return $this->exportPrototype(BaseTypes::FORM);
    }

    /**
     * @param $id
     * @return Context
     */
    protected function createContext($id)
    {
        return new Context($id,null,$this);
    }

    /***************************************************************
     * DEFINE PROTOTYPES
     **************************************************************/

    /**
     * @return Label
     */
    public function getLabelPrototype()
    {
        return $this->getPrototype(BaseTypes::LABEL);
    }

    /**
     * @return Content
     */
    public function getContentPrototype()
    {
        return $this->getPrototype(BaseTypes::CONTENT);
    }

    /**
     * @return Html
     */
    public function getHtmlPrototype()
    {
        return $this->getPrototype(BaseTypes::HTML);
    }

    /**
     * @return HtmlTag
     */
    public function getHtmlTagPrototype()
    {
        return $this->getPrototype(BaseTypes::HTMLTAG);
    }

    /**
     * @return View
     */
    public function getViewPrototype()
    {
        return $this->getPrototype(BaseTypes::VIEW);
    }

    /**
     * @return Input
     */
    public function getInputPrototype()
    {
        return $this->getPrototype(BaseTypes::INPUT);
    }

    /**
     * @return Hidden
     */
    public function getHiddenPrototype()
    {
        return $this->getPrototype(BaseTypes::HIDDEN);
    }

    /**
     * @return Select
     */
    public function getSelectPrototype()
    {
        return $this->getPrototype(BaseTypes::SELECT);
    }

    /**
     * @return Button
     */
    public function getButtonPrototype()
    {
        return $this->getPrototype(BaseTypes::BUTTON);
    }

    /**
     * @return Checkbox
     */
    public function getCheckboxPrototype()
    {
        return $this->getPrototype(BaseTypes::CHECKBOX);
    }

    /**
     * @return Textarea
     */
    public function getTextareaPrototype()
    {
        return $this->getPrototype(BaseTypes::TEXTAREA);
    }

    /**
     * @return Container
     */
    public function getContainerPrototype()
    {
        return $this->getPrototype(BaseTypes::CONTAINER);
    }

    /**
     * @return Field
     */
    public function getFieldPrototype()
    {
        return $this->getPrototype(BaseTypes::FIELD);
    }

    /**
     * @return Fieldset
     */
    public function getFieldsetPrototype()
    {
        return $this->getPrototype(BaseTypes::FIELDSET);
    }

    /**
     * @return Row
     */
    public function getRowPrototype()
    {
        return $this->getPrototype(BaseTypes::ROW);
    }

    /**
     * @return Aggregator
     */
    public function getAggregatorPrototype()
    {
        return $this->getPrototype(BaseTypes::AGGREGATOR);
    }

    /**
     * @return Form
     */
    public function getFormPrototype()
    {
        return $this->getPrototype(BaseTypes::FORM);
    }

    /***************************************************************
     * DEFINE EXTENDED TYPES
     **************************************************************/

    /**
     * @param $name
     * @return Content
     */
    public function defineContent($name)
    {
        return $this->adopt($name,clone $this->getContentPrototype());
    }

    /**
     * @param $name
     * @return Label
     */
    public function defineLabel($name)
    {
        return $this->adopt($name,clone $this->getLabelPrototype());
    }

    /**
     * @param $name
     * @return Html
     */
    public function defineHtml($name)
    {
        return $this->adopt($name,clone $this->getHtmlPrototype());
    }

    /**
     * @param $name
     * @return HtmlTag
     */
    public function defineHtmlTag($name)
    {
        return $this->adopt($name,clone $this->getHtmlTagPrototype());
    }

    /**
     * @param $name
     * @return View
     */
    public function defineView($name)
    {
        return $this->adopt($name,clone $this->getViewPrototype());
    }

    /**
     * @param $name
     * @return Input
     */
    public function defineInput($name)
    {
        return $this->adopt($name,clone $this->getInputPrototype());
    }

    /**
     * @param $name
     * @return Checkbox
     */
    public function defineCheckbox($name)
    {
        return $this->adopt($name,clone $this->getCheckboxPrototype());
    }

    /**
     * @param $name
     * @return Hidden
     */
    public function defineHidden($name)
    {
        return $this->adopt($name,clone $this->getHiddenPrototype());
    }

    /**
     * @param $name
     * @return Select
     */
    public function defineSelect($name)
    {
        return $this->adopt($name,clone $this->getSelectPrototype());
    }

    /**
     * @param $name
     * @return Textarea
     */
    public function defineTextarea($name)
    {
        return $this->adopt($name,clone $this->getTextareaPrototype());
    }

    /**
     * @param $name
     * @return Button
     */
    public function defineButton($name)
    {
        return $this->adopt($name,clone $this->getButtonPrototype());
    }

    /**
     * @param $name
     * @return Container
     */
    public function defineContainer($name)
    {
        return $this->adopt($name,clone $this->getContainerPrototype());
    }

    /**
     * @param $name
     * @return Field
     */
    public function defineField($name)
    {
        return $this->adopt($name,clone $this->getFieldPrototype());
    }

    /**
     * @param $name
     * @return Fieldset
     */
    public function defineFieldset($name)
    {
        return $this->adopt($name,clone $this->getFieldsetPrototype());
    }

    /**
     * @param $name
     * @return Row
     */
    public function defineRow($name)
    {
        return $this->adopt($name,clone $this->getRowPrototype());
    }

    /**
     * @param $name
     * @return Aggregator
     */
    public function defineAggregator($name)
    {
        return $this->adopt($name,clone $this->getAggregatorPrototype());
    }

    /***************************************************************
     * EXTEND
     **************************************************************/

    /**
     * @param $parentName
     * @param $name
     * @return Input
     */
    public function extendInput($parentName,$name)
    {
        return $this->extendComponent($parentName,$name,Input::class);
    }

    /**
     * @param $parentName
     * @param $name
     * @return Checkbox
     */
    public function extendCheckbox($parentName,$name)
    {
        return $this->extendComponent($parentName,$name,Input::class);
    }

    /**
     * @param $parentName
     * @param $name
     * @return Select
     */
    public function extendSelect($parentName,$name)
    {
        return $this->extendComponent($parentName,$name,Select::class);
    }

    /**
     * @param $parentName
     * @param $name
     * @return Textarea
     */
    public function extendTextarea($parentName,$name)
    {
        return $this->extendComponent($parentName,$name,Textarea::class);
    }

    /**
     * @param $parentName
     * @param $name
     * @return Button
     * @throws FormException
     */
    public function extendButton($parentName,$name)
    {
        return $this->extendComponent($parentName,$name,Button::class);
    }

    /**
     * @param $parentName
     * @param $name
     * @return Container
     * @throws FormException
     */
    public function extendContainer($parentName,$name)
    {
        return $this->extendComponent($parentName,$name,Container::class);
    }

    /**
     * @param $parentName
     * @param $name
     * @return Aggregator
     * @throws FormException
     */
    public function extendAggregator($parentName,$name)
    {
        return $this->extendComponent($parentName,$name,Aggregator::class);
    }

    /**
     * @param $parentName
     * @param $name
     * @return Container
     * @throws FormException
     */
    public function extendFieldset($parentName,$name)
    {
        return $this->extendComponent($parentName,$name,Fieldset::class);
    }

    /**
     * @param $parentName
     * @param $name
     * @return Field
     * @throws FormException
     */
    public function extendField($parentName,$name)
    {
        return $this->extendComponent($parentName,$name,Field::class);
    }

    /**
     * @param $parentName
     * @param $name
     * @return Row
     * @throws FormException
     */
    public function extendRow($parentName,$name)
    {
        return $this->extendComponent($parentName,$name,Row::class);
    }

    /**
     * @param $parentName
     * @param $name
     * @param $type
     * @return ComponentInterface
     * @throws FormException
     */
    protected function extendComponent($parentName,$name,$type)
    {
        // if parent component not found, throw exception
        if(!$this->hasComponent($parentName))
        {
            throw new FormException(sprintf("Cannot extend prototype in container: unknown parent '%'",$parentName));
        }

        // set parent variable
        $parent = $this->getComponent($parentName);

        // if parent found, but of wrong type, throw exception
        if(!($parent instanceof $type))
        {
            throw new FormException(sprintf("Cannot extend prototype in container: parent not of type '%s'",$type));
        }

        // clone the original
        $clone = $this->cloneComponent($parentName);

        // add the cloned component
        $this->adopt($name,$clone);

        return $clone;
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
        return $this->getComponent($name,Input::class);
    }

    /**
     * @param $name
     * @return Checkbox
     * @throws FormException
     */
    public function getDefinedCheckbox($name)
    {
        return $this->getComponent($name,Checkbox::class);
    }

    /**
     * @param $name
     * @return Select
     * @throws FormException
     */
    public function getDefinedSelect($name)
    {
        return $this->getComponent($name,Select::class);
    }

    /**
     * @param $name
     * @return Textarea
     * @throws FormException
     */
    public function getDefinedTextarea($name)
    {
        return $this->getComponent($name,Textarea::class);
    }

    /**
     * @param $name
     * @return Button
     * @throws FormException
     */
    public function getDefinedButton($name)
    {
        return $this->getComponent($name,Button::class);
    }

    /**
     * @param $name
     * @return Container
     * @throws FormException
     */
    public function getDefinedContainer($name)
    {
        return $this->getComponent($name,Container::class);
    }

    /**
     * @param $name
     * @return Aggregator
     * @throws FormException
     */
    public function getDefinedAggregator($name)
    {
        return $this->getComponent($name,Aggregator::class);
    }

    /**
     * @param $name
     * @return Container
     * @throws FormException
     */
    public function getDefinedFieldset($name)
    {
        return $this->getComponent($name,Fieldset::class);
    }

    /**
     * @param $name
     * @return Container
     * @throws FormException
     */
    public function getDefinedField($name)
    {
        return $this->getComponent($name,Field::class);
    }

    /**
     * @param $name
     * @return Row
     * @throws FormException
     */
    public function getDefinedRow($name)
    {
        return $this->getComponent($name,Row::class);
    }
}