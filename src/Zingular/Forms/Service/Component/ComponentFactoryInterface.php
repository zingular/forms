<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 12-3-2016
 * Time: 10:18
 */

namespace Zingular\Forms\Service\Component;
use Zingular\Forms\Component\Containers\Aggregator;
use Zingular\Forms\Component\Containers\Container;
use Zingular\Forms\Component\Containers\Form;
use Zingular\Forms\Component\Containers\Prototypes;
use Zingular\Forms\Component\Elements\Contents\Content;
use Zingular\Forms\Component\Elements\Contents\Html;
use Zingular\Forms\Component\Elements\Contents\HtmlTag;
use Zingular\Forms\Component\Elements\Contents\Label;
use Zingular\Forms\Component\Elements\Contents\View;
use Zingular\Forms\Component\Elements\Controls\Button;
use Zingular\Forms\Component\Elements\Controls\Checkbox;
use Zingular\Forms\Component\Elements\Controls\FileUpload;
use Zingular\Forms\Component\Elements\Controls\Hidden;
use Zingular\Forms\Component\Elements\Controls\Input;
use Zingular\Forms\Component\Elements\Controls\Select;
use Zingular\Forms\Component\Elements\Controls\Textarea;


/**
 * Interface ComponentFactoryInterface
 * @package Zingular\Forms\Service\Component
 */
interface ComponentFactoryInterface
{
    /**
     * @return Content
     */
    public function createContent();

    /**
     * @return Label
     */
    public function createLabel();

    /**
     * @return Html
     */
    public function createHtml();

    /**
     * @return HtmlTag
     */
    public function createHtmlTag();

    /**
     * @return View
     */
    public function createView();

    /**
     * @return Input
     */
    public function createInput();

    /**
     * @return Checkbox
     */
    public function createCheckbox();

    /**
     * @return Button
     */
    public function createButton();

    /**
     * @return Select
     */
    public function createSelect();

    /**
     * @return Hidden
     */
    public function createHidden();

    /**
     * @return Textarea
     */
    public function createTextarea();

    /**
     * @return FileUpload
     */
    public function createFileUpload();

    /**
     * @return Container
     */
    public function createContainer();

    /**
     * @return Container
     */
    public function createField();

    /**
     * @return Container
     */
    public function createFieldset();
    /**
     * @return Container
     */
    public function createRow();

    /**
     * @return Aggregator
     */
    public function createAggregator();

    /**
     * @return Prototypes
     */
    public function createPrototypes();

    /**
     * @return Form
     */
    public function createForm();
}