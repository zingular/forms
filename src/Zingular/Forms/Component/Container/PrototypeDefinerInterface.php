<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 21:19
 */

namespace Zingular\Forms\Component\Container;
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

/**
 * Interface PrototypeDefinerInterface
 * @package Zingular\Form\Component\Container
 */
interface PrototypeDefinerInterface
{
    // TODO: also add extend-methods


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
     * @return Aggregator
     */
    public function defineAggregator($name);
}