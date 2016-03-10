<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 8-3-2016
 * Time: 20:15
 */

namespace Zingular\Forms\Component\Container;
use Zingular\Forms\Component\ComponentInterface;
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
use Zingular\Forms\Exception\FormException;

/**
 * Interface BuildableInterface
 * @package Zingular\Forms\Component\Container
 */
interface BuildableInterface extends ContainerInterface
{
    /**
     * @return string
     */
    public function getId();

    /**
     * @return string
     */
    public function getFullId();

    /***************************************************************
     * GENERIC
     **************************************************************/

    /**
     * @param $name
     * @return $this
     */
    public function removeComponent($name);

    /***************************************************************
     * GET
     **************************************************************/

    /**
     * @param $name
     * @return Input
     * @throws FormException
     */
    public function getInput($name);

    /**
     * @param $name
     * @return Checkbox
     * @throws FormException
     */
    public function getCheckbox($name);

    /**
     * @param $name
     * @return Select
     * @throws FormException
     */
    public function getSelect($name);

    /**
     * @param $name
     * @return Textarea
     * @throws FormException
     */
    public function getTextarea($name);

    /**
     * @param $name
     * @return Button
     * @throws FormException
     */
    public function getButton($name);

    /**
     * @param $name
     * @return Container
     * @throws FormException
     */
    public function getContainer($name);

    /**
     * @param $name
     * @return Aggregator
     * @throws FormException
     */
    public function getAggregator($name);

    /**
     * @param $name
     * @return Container
     * @throws FormException
     */
    public function getFieldset($name);

    /**
     * @param $name
     * @return Container
     * @throws FormException
     */
    public function getField($name);

    /**
     * @param $name
     * @return Row
     * @throws FormException
     */
    public function getRow($name);

    /***************************************************************
     * DEFINE
     **************************************************************/


    /**
     * @param $name
     * @param string $position
     * @return Label
     */
    public function addContent($name,$position = self::END);

    /**
     * @param $name
     * @param string $position
     * @return Label
     */
    public function addLabel($name,$position = self::END);

    /**
     * @param $name
     * @param string $position
     * @return Html
     */
    public function addHtml($name,$position = self::END);

    /**
     * @param $name
     * @param string $position
     * @return HtmlTag
     */
    public function addHtmlTag($name,$position = self::END);

    /**
     * @param $name
     * @param string $position
     * @return View
     */
    public function addView($name,$position = self::END);

    /**
     * @param $name
     * @param string $position
     * @return Input
     */
    public function addInput($name,$position = self::END);
    /**
     * @param $name
     * @param string $position
     * @return Checkbox
     */
    public function addCheckbox($name,$position = self::END);

    /**
     * @param $name
     * @param string $position
     * @return Hidden
     */
    public function addHidden($name,$position = self::END);

    /**
     * @param $name
     * @param string $position
     * @return Select
     */
    public function addSelect($name,$position = self::END);

    /**
     * @param $name
     * @param string $position
     * @return Textarea
     */
    public function addTextarea($name,$position = self::END);

    /**
     * @param $name
     * @param string $position
     * @return Button
     */
    public function addButton($name,$position = self::END);

    /**
     * @param $name
     * @param string $position
     * @return Container
     */
    public function addContainer($name,$position = self::END);

    /**
     * @param $name
     * @param string $position
     * @return Aggregator
     */
    public function addAggregator($name,$position = self::END);

    /**
     * @param $name
     * @param string $position
     * @return Fieldset
     */
    public function addFieldset($name,$position = self::END);

    /**
     * @param $name
     * @param string $position
     * @return Container
     */
    public function addField($name,$position = self::END);

    /**
     * @param $name
     * @param string $position
     * @return Row
     */
    public function addRow($name,$position = self::END);

    /***************************************************************
     * USE (import prototypes)
     **************************************************************/

    /**
     * @param $prototype
     * @param null $as
     * @param string $position
     * @return Label
     */
    public function useContent($prototype,$as = null,$position = self::END);

    /**
     * @param $prototype
     * @param null $as
     * @param string $position
     * @return Label
     */
    public function useLabel($prototype,$as = null,$position = self::END);

    /**
     * @param $prototype
     * @param null $as
     * @param string $position
     * @return Html
     */
    public function useHtml($prototype,$as = null,$position = self::END);

    /**
     * @param $prototype
     * @param null $as
     * @param string $position
     * @return HtmlTag
     */
    public function useHtmlTag($prototype,$as = null,$position = self::END);

    /**
     * @param $prototype
     * @param null $as
     * @param string $position
     * @return View
     */
    public function useView($prototype,$as = null,$position = self::END);

    /**
     * @param $prototype
     * @param null $as
     * @param string $position
     * @return Input
     */
    public function useInput($prototype,$as = null,$position = self::END);

    /**
     * @param $prototype
     * @param null $as
     * @param string $position
     * @return Checkbox
     */
    public function useCheckbox($prototype,$as = null,$position = self::END);

    /**
     * @param $prototype
     * @param null $as
     * @param string $position
     * @return Select
     */
    public function useSelect($prototype,$as = null,$position = self::END);

    /**
     * @param $prototype
     * @param null $as
     * @param string $position
     * @return Textarea
     */
    public function useTextarea($prototype,$as = null,$position = self::END);

    /**
     * @param $prototype
     * @param null $as
     * @param string $position
     * @return Button
     */
    public function useButton($prototype,$as = null,$position = self::END);

    /**
     * @param $prototype
     * @param null $as
     * @param string $position
     * @return Container
     */
    public function useContainer($prototype,$as = null,$position = self::END);

    /**
     * @param $prototype
     * @param null $as
     * @param string $position
     * @return Aggregator
     */
    public function useAggregator($prototype,$as = null,$position = self::END);

    /**
     * @param $prototype
     * @param null $as
     * @param string $position
     * @return Fieldset
     */
    public function useFieldset($prototype,$as = null,$position = self::END);

    /**
     * @param $prototype
     * @param null $as
     * @param string $position
     * @return Field
     */
    public function useField($prototype,$as = null,$position = self::END);

    /**
     * @param $prototype
     * @param null $as
     * @param string $position
     * @return Row
     */
    public function useRow($prototype,$as = null,$position = self::END);

    /***************************************************************
     * IMPORT
     **************************************************************/

    /**
     * @param ComponentInterface $component
     * @param string $name
     * @return ComponentInterface
     */
    public function import(ComponentInterface $component,$name);
}