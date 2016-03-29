<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 29-1-2016
 * Time: 19:34
 */

namespace Zingular\Forms\Service\Component;
use Zingular\Forms\Component\Containers\Aggregator;
use Zingular\Forms\Component\Containers\Form;
use Zingular\Forms\Component\Containers\Prototypes;
use Zingular\Forms\Component\Elements\Controls\Button;
use Zingular\Forms\Component\Containers\Container;
use Zingular\Forms\Component\Elements\Contents\Content;
use Zingular\Forms\Component\Elements\Contents\Html;
use Zingular\Forms\Component\Elements\Contents\HtmlTag;
use Zingular\Forms\Component\Elements\Contents\Label;
use Zingular\Forms\Component\Elements\Contents\View;
use Zingular\Forms\Component\Elements\Controls\Checkbox;
use Zingular\Forms\Component\Elements\Controls\FileUpload;
use Zingular\Forms\Component\Elements\Controls\Hidden;
use Zingular\Forms\Component\Elements\Controls\Input;
use Zingular\Forms\Component\Elements\Controls\Select;
use Zingular\Forms\Component\Elements\Controls\Textarea;


/**
 * Class ComponentFactory
 * @package Zingular\Form\Component
 */
class ComponentFactory implements ComponentFactoryInterface
{
    /**
     * @return Content
     */
    public function createContent()
    {
        return new Content();
    }

    /**
     * @return Label
     */
    public function createLabel()
    {
        return new Label();
    }

    /**
     * @return Html
     */
    public function createHtml()
    {
        return new Html();
    }

    /**
     * @return HtmlTag
     */
    public function createHtmlTag()
    {
        return new HtmlTag();
    }

    /**
     * @return View
     */
    public function createView()
    {
        return new View();
    }

    /**
     * @return Input
     */
    public function createInput()
    {
        return new Input();
    }

    /**
     * @return Checkbox
     */
    public function createCheckbox()
    {
        return new Checkbox();
    }

    /**
     * @return Button
     */
    public function createButton()
    {
        return new Button();
    }

    /**
     * @return Select
     */
    public function createSelect()
    {
        return new Select();
    }

    /**
     * @return Hidden
     */
    public function createHidden()
    {
        return new Hidden();
    }

    /**
     * @return Textarea
     */
    public function createTextarea()
    {
        return new Textarea();
    }

    /**
     * @return FileUpload
     */
    public function createFileUpload()
    {
        return new FileUpload();
    }

    /**
     * @return Container
     */
    public function createContainer()
    {
        return new Container();
    }

    /**
     * @return Container
     */
    public function createField()
    {
        return new Container();
    }

    /**
     * @return Container
     */
    public function createFieldset()
    {
        return new Container();
    }

    /**
     * @return Container
     */
    public function createRow()
    {
       return new Container();
    }

    /**
     * @return Aggregator
     */
    public function createAggregator()
    {
        return new Aggregator();
    }

    /**
     * @return Prototypes
     */
    public function createPrototypes()
    {
        return new Prototypes($this);
    }

    /**
     * @return Form
     */
    public function createForm()
    {
        return new Form();
    }
}