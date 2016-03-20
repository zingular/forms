<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 21:19
 */

namespace Zingular\Forms\Component\Containers;
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
use Zingular\Forms\Exception\FormException;

/**
 * Interface PrototypesInterface
 * @package Zingular\Form\Component\Container
 */
interface PrototypesInterface
{
    /***************************************************************
     * DEFINE PROTOTYPES
     **************************************************************/

    /**
     * @return Label
     */
    public function getLabelPrototype();

    /**
     * @return Content
     */
    public function getContentPrototype();

    /**
     * @return Html
     */
    public function getHtmlPrototype();

    /**
     * @return HtmlTag
     */
    public function getHtmlTagPrototype();

    /**
     * @return View
     */
    public function getViewPrototype();

    /**
     * @return Input
     */
    public function getInputPrototype();

    /**
     * @return Hidden
     */
    public function getHiddenPrototype();

    /**
     * @return Select
     */
    public function getSelectPrototype();

    /**
     * @return Button
     */
    public function getButtonPrototype();

    /**
     * @return Checkbox
     */
    public function getCheckboxPrototype();

    /**
     * @return Textarea
     */
    public function getTextareaPrototype();

    /**
     * @return FileUpload
     */
    public function getFileUploadPrototype();

    /**
     * @return Container
     */
    public function getContainerPrototype();

    /**
     * @return Field
     */
    public function getFieldPrototype();

    /**
     * @return Fieldset
     */
    public function getFieldsetPrototype();

    /**
     * @return Row
     */
    public function getRowPrototype();

    /**
     * @return Aggregator
     */
    public function getAggregatorPrototype();

    /**
     * @return Form
     */
    public function getFormPrototype();

     /***************************************************************
     * DEFINE
     **************************************************************/

    /**
     * @param string $name
     * @return Content
     */
    public function defineContent($name);

    /**
     * @param string $name
     * @return Label
     */
    public function defineLabel($name);

    /**
     * @param string $name
     * @return Html
     */
    public function defineHtml($name);

    /**
     * @param string $name
     * @return HtmlTag
     */
    public function defineHtmlTag($name);

    /**
     * @param string $name
     * @return View
     */
    public function defineView($name);

    /**
     * @param string $name
     * @return Input
     */
    public function defineInput($name);

    /**
     * @param string $name
     * @return Checkbox
     */
    public function defineCheckbox($name);

    /**
     * @param string $name
     * @return Hidden
     */
    public function defineHidden($name);

    /**
     * @param string $name
     * @return Select
     */
    public function defineSelect($name);

    /**
     * @param string $name
     * @return Textarea
     */
    public function defineTextarea($name);

    /**
     * @param string $name
     * @return FileUpload
     */
    public function defineFileUpload($name);

    /**
     * @param string $name
     * @return Button
     */
    public function defineButton($name);

    /**
     * @param string $name
     * @return Container
     */
    public function defineContainer($name);

    /**
     * @param string $name
     * @return Field
     */
    public function defineField($name);

    /**
     * @param string $name
     * @return Fieldset
     */
    public function defineFieldset($name);

    /**
     * @param string $name
     * @return Row
     */
    public function defineRow($name);

    /**
     * @param string $name
     * @return Aggregator
     */
    public function defineAggregator($name);

    /***************************************************************
     * EXTEND
     **************************************************************/

    /**
     * @param string $parentName
     * @param string $name
     * @return Input
     */
    public function extendInput($parentName,$name);

    /**
     * @param string $parentName
     * @param string $name
     * @return Checkbox
     */
    public function extendCheckbox($parentName,$name);

    /**
     * @param string $parentName
     * @param string $name
     * @return Select
     */
    public function extendSelect($parentName,$name);

    /**
     * @param string $parentName
     * @param string $name
     * @return Textarea
     */
    public function extendTextarea($parentName,$name);

    /**
     * @param string $parentName
     * @param string $name
     * @return FileUpload
     */
    public function extendFileUpload($parentName,$name);

    /**
     * @param string $parentName
     * @param string $name
     * @return Button
     * @throws FormException
     */
    public function extendButton($parentName,$name);

    /**
     * @param string $parentName
     * @param string $name
     * @return Container
     * @throws FormException
     */
    public function extendContainer($parentName,$name);

    /**
     * @param string $parentName
     * @param string $name
     * @return Aggregator
     * @throws FormException
     */
    public function extendAggregator($parentName,$name);

    /**
     * @param string $parentName
     * @param string $name
     * @return Container
     * @throws FormException
     */
    public function extendFieldset($parentName,$name);

    /**
     * @param string $parentName
     * @param string $name
     * @return Container
     * @throws FormException
     */
    public function extendField($parentName,$name);

    /**
     * @param string $parentName
     * @param string $name
     * @return Row
     * @throws FormException
     */
    public function extendRow($parentName,$name);

    /***************************************************************
     * GETTERS
     **************************************************************/

    /**
     * @param string $name
     * @return Input
     * @throws FormException
     */
    public function getDefinedInput($name);

    /**
     * @param string $name
     * @return Checkbox
     * @throws FormException
     */
    public function getDefinedCheckbox($name);

    /**
     * @param string $name
     * @return Select
     * @throws FormException
     */
    public function getDefinedSelect($name);

    /**
     * @param string $name
     * @return Textarea
     * @throws FormException
     */
    public function getDefinedTextarea($name);

    /**
     * @param string $name
     * @return FileUpload
     * @throws FormException
     */
    public function getDefinedFileUpload($name);

    /**
     * @param string $name
     * @return Button
     * @throws FormException
     */
    public function getDefinedButton($name);

    /**
     * @param string $name
     * @return Container
     * @throws FormException
     */
    public function getDefinedContainer($name);

    /**
     * @param string $name
     * @return Aggregator
     * @throws FormException
     */
    public function getDefinedAggregator($name);

    /**
     * @param string $name
     * @return Container
     * @throws FormException
     */
    public function getDefinedFieldset($name);

    /**
     * @param string $name
     * @return Container
     * @throws FormException
     */
    public function getDefinedField($name);

    /**
     * @param string $name
     * @return Row
     * @throws FormException
     */
    public function getDefinedRow($name);
}