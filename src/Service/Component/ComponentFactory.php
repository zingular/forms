<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 29-1-2016
 * Time: 19:34
 */

namespace Zingular\Form\Service\Component;
use Zingular\Form\BaseTypes;
use Zingular\Form\Component\ComponentInterface;
use Zingular\Form\Component\Container\Aggregator;
use Zingular\Form\Component\Container\Field;
use Zingular\Form\Component\Container\Fieldset;
use Zingular\Form\Component\Container\Prototypes;
use Zingular\Form\Component\Element\Control\Button;
use Zingular\Form\Component\Container\Container;
use Zingular\Form\Component\Element\Content\Content;
use Zingular\Form\Component\Element\Content\Html;
use Zingular\Form\Component\Element\Content\HtmlTag;
use Zingular\Form\Component\Element\Content\Label;
use Zingular\Form\Component\Element\Content\View;
use Zingular\Form\Component\Element\Control\Checkbox;
use Zingular\Form\Component\Element\Control\Hidden;
use Zingular\Form\Component\Element\Control\Input;
use Zingular\Form\Component\Element\Control\Select;
use Zingular\Form\Component\Element\Control\Textarea;
use Zingular\Form\Exception\FormException;

/**
 * Class ComponentFactory
 * @package Zingular\Form\Component
 */
class ComponentFactory
{
    /**
     * @param $type
     * @return ComponentInterface
     * @throws FormException
     */
    public function create($type)
    {
        switch($type)
        {
            case BaseTypes::AGGREGATOR: return $this->createAggregator();
            case BaseTypes::FIELD: return $this->createField();
            case BaseTypes::FIELDSET: return $this->createFieldset();
            case BaseTypes::BUTTON: return $this->createButton();
            case BaseTypes::CONTAINER: return $this->createContainer();
            case BaseTypes::CONTENT: return $this->createContent();
            case BaseTypes::HTML: return $this->createHtml();
            case BaseTypes::HTMLTAG: return $this->createHtmlTag();
            case BaseTypes::LABEL: return $this->createLabel();
            case BaseTypes::VIEW: return $this->createView();
            case BaseTypes::CHECKBOX: return $this->createCheckbox();
            case BaseTypes::INPUT: return $this->createInput();
            case BaseTypes::HIDDEN: return $this->createHidden();
            case BaseTypes::SELECT: return $this->createSelect();
            case BaseTypes::TEXTAREA: return $this->createTextarea();
        }

        throw new FormException(sprintf("Cannot create form component: unknown component type '%s'",$type));
    }

    /**
     * @return Content
     */
    protected function createContent()
    {
        return new Content();
    }

    /**
     * @return Content
     */
    protected function createLabel()
    {
        return new Label();
    }

    /**
     * @return Html
     */
    protected function createHtml()
    {
        return new Html();
    }

    /**
     * @return HtmlTag
     */
    protected function createHtmlTag()
    {
        return new HtmlTag();
    }

    /**
     * @return View
     */
    protected function createView()
    {
        return new View();
    }

    /**
     * @return Input
     */
    protected function createInput()
    {
        return new Input();
    }

    /**
     * @return Input
     */
    protected function createCheckbox()
    {
        return new Checkbox();
    }

    /**
     * @return Button
     */
    protected function createButton()
    {
        return new Button();
    }

    /**
     * @return Select
     */
    protected function createSelect()
    {
        return new Select();
    }

    /**
     * @return Hidden
     */
    protected function createHidden()
    {
        return new Hidden();
    }

    /**
     * @return Textarea
     */
    protected function createTextarea()
    {
        return new Textarea();
    }

    /**
     * @return Container
     */
    protected function createContainer()
    {
        return new Container();
    }

    /**
     * @return Field
     */
    protected function createField()
    {
        return new Field();
    }

    /**
     * @return Fieldset
     */
    protected function createFieldset()
    {
        return new Fieldset();
    }

    /**
     * @return Aggregator
     */
    protected function createAggregator()
    {
        return new Aggregator();
    }
}