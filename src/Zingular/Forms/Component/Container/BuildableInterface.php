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
     * DEFINE
     **************************************************************/

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

    /***************************************************************
     * USE (import prototypes)
     **************************************************************/

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