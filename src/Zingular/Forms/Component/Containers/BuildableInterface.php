<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 8-3-2016
 * Time: 20:15
 */

namespace Zingular\Forms\Component\Containers;
use Zingular\Forms\Component\ComponentInterface;
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

/**
 * Interface BuildableInterface
 * @package Zingular\Forms\Component\Container
 */
interface BuildableInterface extends ContainerInterface,PositionableInterface
{
    /***************************************************************
     * DEFINE
     **************************************************************/

    /**
     * @param $name
     * @param int|string $position
     * @return Label
     */
    public function addContent($name,$position = self::POSITION_END);

    /**
     * @param $name
     * @param int|string $position
     * @return Label
     */
    public function addLabel($name,$position = self::POSITION_END);

    /**
     * @param $name
     * @param int|string $position
     * @return Html
     */
    public function addHtml($name,$position = self::POSITION_END);

    /**
     * @param $name
     * @param int|string $position
     * @return HtmlTag
     */
    public function addHtmlTag($name,$position = self::POSITION_END);

    /**
     * @param $name
     * @param int|string $position
     * @return View
     */
    public function addView($name,$position = self::POSITION_END);

    /**
     * @param $name
     * @param int|string $position
     * @return Input
     */
    public function addInput($name,$position = self::POSITION_END);
    /**
     * @param $name
     * @param int|string $position
     * @return Checkbox
     */
    public function addCheckbox($name,$position = self::POSITION_END);

    /**
     * @param $name
     * @param int|string $position
     * @return Hidden
     */
    public function addHidden($name,$position = self::POSITION_END);

    /**
     * @param $name
     * @param int|string $position
     * @return Select
     */
    public function addSelect($name,$position = self::POSITION_END);

    /**
     * @param $name
     * @param int|string $position
     * @return Textarea
     */
    public function addTextarea($name,$position = self::POSITION_END);

    /**
     * @param $name
     * @param int|string $position
     * @return Button
     */
    public function addButton($name,$position = self::POSITION_END);

    /**
     * @param $name
     * @param int|string $position
     * @return Container
     */
    public function addContainer($name,$position = self::POSITION_END);

    /**
     * @param $name
     * @param int|string $position
     * @return Aggregator
     */
    public function addAggregator($name,$position = self::POSITION_END);

    /**
     * @param $name
     * @param int|string $position
     * @return Fieldset
     */
    public function addFieldset($name,$position = self::POSITION_END);

    /**
     * @param $name
     * @param int|string $position
     * @return Container
     */
    public function addField($name,$position = self::POSITION_END);

    /**
     * @param $name
     * @param int|string $position
     * @return Row
     */
    public function addRow($name,$position = self::POSITION_END);

    /***************************************************************
     * USE (import prototypes)
     **************************************************************/

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Label
     */
    public function useContent($prototype,$as = null,$position = self::POSITION_END);

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Label
     */
    public function useLabel($prototype,$as = null,$position = self::POSITION_END);

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Html
     */
    public function useHtml($prototype,$as = null,$position = self::POSITION_END);

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return HtmlTag
     */
    public function useHtmlTag($prototype,$as = null,$position = self::POSITION_END);

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return View
     */
    public function useView($prototype,$as = null,$position = self::POSITION_END);

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Input
     */
    public function useInput($prototype,$as = null,$position = self::POSITION_END);

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Checkbox
     */
    public function useCheckbox($prototype,$as = null,$position = self::POSITION_END);

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Select
     */
    public function useSelect($prototype,$as = null,$position = self::POSITION_END);

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Textarea
     */
    public function useTextarea($prototype,$as = null,$position = self::POSITION_END);

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Button
     */
    public function useButton($prototype,$as = null,$position = self::POSITION_END);

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Container
     */
    public function useContainer($prototype,$as = null,$position = self::POSITION_END);

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Aggregator
     */
    public function useAggregator($prototype,$as = null,$position = self::POSITION_END);

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Fieldset
     */
    public function useFieldset($prototype,$as = null,$position = self::POSITION_END);

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Field
     */
    public function useField($prototype,$as = null,$position = self::POSITION_END);

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Row
     */
    public function useRow($prototype,$as = null,$position = self::POSITION_END);

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