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

     /***************************************************************
     * DEFINE
     **************************************************************/

    /**
     * @param $name
     * @return Content
     */
    public function defineContent($name);

    /**
     * @param $name
     * @return Label
     */
    public function defineLabel($name);

    /**
     * @param $name
     * @return Html
     */
    public function defineHtml($name);

    /**
     * @param $name
     * @return HtmlTag
     */
    public function defineHtmlTag($name);

    /**
     * @param $name
     * @return View
     */
    public function defineView($name);

    /**
     * @param $name
     * @return Input
     */
    public function defineInput($name);

    /**
     * @param $name
     * @return Checkbox
     */
    public function defineCheckbox($name);

    /**
     * @param $name
     * @return Hidden
     */
    public function defineHidden($name);

    /**
     * @param $name
     * @return Select
     */
    public function defineSelect($name);

    /**
     * @param $name
     * @return Textarea
     */
    public function defineTextarea($name);

    /**
     * @param $name
     * @return Button
     */
    public function defineButton($name);

    /**
     * @param $name
     * @return Container
     */
    public function defineContainer($name);

    /**
     * @param $name
     * @return Field
     */
    public function defineField($name);

    /**
     * @param $name
     * @return Fieldset
     */
    public function defineFieldset($name);

    /**
     * @param $name
     * @return Row
     */
    public function defineRow($name);

    /**
     * @param $name
     * @return Aggregator
     */
    public function defineAggregator($name);

    /***************************************************************
     * EXTEND
     **************************************************************/

    /**
     * @param $parentName
     * @param $name
     * @return Input
     */
    public function extendInput($parentName,$name);

    /**
     * @param $parentName
     * @param $name
     * @return Checkbox
     */
    public function extendCheckbox($parentName,$name);

    /**
     * @param $parentName
     * @param $name
     * @return Select
     */
    public function extendSelect($parentName,$name);

    /**
     * @param $parentName
     * @param $name
     * @return Textarea
     */
    public function extendTextarea($parentName,$name);

    /**
     * @param $parentName
     * @param $name
     * @return Button
     * @throws FormException
     */
    public function extendButton($parentName,$name);

    /**
     * @param $parentName
     * @param $name
     * @return Container
     * @throws FormException
     */
    public function extendContainer($parentName,$name);

    /**
     * @param $parentName
     * @param $name
     * @return Aggregator
     * @throws FormException
     */
    public function extendAggregator($parentName,$name);

    /**
     * @param $parentName
     * @param $name
     * @return Container
     * @throws FormException
     */
    public function extendFieldset($parentName,$name);

    /**
     * @param $parentName
     * @param $name
     * @return Container
     * @throws FormException
     */
    public function extendField($parentName,$name);

    /**
     * @param $parentName
     * @param $name
     * @return Row
     * @throws FormException
     */
    public function extendRow($parentName,$name);

    /***************************************************************
     * GETTERS
     **************************************************************/

    /**
     * @param $name
     * @return Input
     * @throws FormException
     */
    public function getDefinedInput($name);

    /**
     * @param $name
     * @return Checkbox
     * @throws FormException
     */
    public function getDefinedCheckbox($name);

    /**
     * @param $name
     * @return Select
     * @throws FormException
     */
    public function getDefinedSelect($name);

    /**
     * @param $name
     * @return Textarea
     * @throws FormException
     */
    public function getDefinedTextarea($name);

    /**
     * @param $name
     * @return Button
     * @throws FormException
     */
    public function getDefinedButton($name);

    /**
     * @param $name
     * @return Container
     * @throws FormException
     */
    public function getDefinedContainer($name);

    /**
     * @param $name
     * @return Aggregator
     * @throws FormException
     */
    public function getDefinedAggregator($name);

    /**
     * @param $name
     * @return Container
     * @throws FormException
     */
    public function getDefinedFieldset($name);

    /**
     * @param $name
     * @return Container
     * @throws FormException
     */
    public function getDefinedField($name);

    /**
     * @param $name
     * @return Row
     * @throws FormException
     */
    public function getDefinedRow($name);
}