<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 29-1-2016
 * Time: 19:34
 */

namespace Zingular\Forms\Service\Component;
use Zingular\Forms\BaseTypes;
use Zingular\Forms\Component\ComponentInterface;
use Zingular\Forms\Component\Container\Aggregator;
use Zingular\Forms\Component\Container\Field;
use Zingular\Forms\Component\Container\Fieldset;
use Zingular\Forms\Component\Element\Control\Button;
use Zingular\Forms\Component\Container\Container;
use Zingular\Forms\Component\Element\Content\Content;
use Zingular\Forms\Component\Element\Content\Html;
use Zingular\Forms\Component\Element\Content\HtmlTag;
use Zingular\Forms\Component\Element\Content\Label;
use Zingular\Forms\Component\Element\Content\View;
use Zingular\Forms\Component\Element\Control\Checkbox;
use Zingular\Forms\Component\Element\Control\Hidden;
use Zingular\Forms\Component\Element\Control\Input;
use Zingular\Forms\Component\Element\Control\Select;
use Zingular\Forms\Component\Element\Control\Textarea;
use Zingular\Forms\Exception\FormException;

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