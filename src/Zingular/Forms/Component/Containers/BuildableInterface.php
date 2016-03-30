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
use Zingular\Forms\Component\Elements\Controls\FileUpload;
use Zingular\Forms\Component\Elements\Controls\Hidden;
use Zingular\Forms\Component\Elements\Controls\Input;
use Zingular\Forms\Component\Elements\Controls\Select;
use Zingular\Forms\Component\Elements\Controls\Textarea;
use Zingular\Forms\Exception\FormException;
use Zingular\Forms\Plugins\Builders\Container\SimpleBuilderInterface;
use Zingular\Forms\Plugins\Builders\Container\BuilderInterface;
use Zingular\Forms\Events\EventDispatcherInterface;

/**
 * Interface BuildableInterface
 * @package Zingular\Forms\Component\Container
 */
interface BuildableInterface extends ContainerInterface,PositionableInterface,EventDispatcherInterface
{
    const ERRORS_CHILDREN = 'children';
    const ERRORS_DESCENDANTS = 'descendants';
    const ERRORS_NONE = 'none';

    /***************************************************************
     * BUILDER
     **************************************************************/

    /**
     * @param string|SimpleBuilderInterface|BuilderInterface|callable $builder
     */
    public function setErrorBuilder($builder);

    /**
     * @param string|SimpleBuilderInterface|BuilderInterface|callable $builder
     * @return $this
     */
    public function addBuilder($builder);

    /**
     * @return $this
     */
    public function setOptions($options);

    /***************************************************************
     * GENERIC
     **************************************************************/

    /**
     * @param string $name
     * @return $this
     */
    public function removeComponent($name);

    /**
     * @param $show
     * @return string|bool
     */
    public function showErrors($show = self::ERRORS_CHILDREN);

    /***************************************************************
     * GET
     **************************************************************/

    /**
     * @param string $name
     * @return Input
     * @throws FormException
     */
    public function getInput($name);

    /**
     * @param string $name
     * @return Checkbox
     * @throws FormException
     */
    public function getCheckbox($name);

    /**
     * @param string $name
     * @return Select
     * @throws FormException
     */
    public function getSelect($name);

    /**
     * @param string $name
     * @return Textarea
     * @throws FormException
     */
    public function getTextarea($name);

    /**
     * @param string $name
     * @return FileUpload
     * @throws FormException
     */
    public function getFileUpload($name);

    /**
     * @param string $name
     * @return Button
     * @throws FormException
     */
    public function getButton($name);

    /**
     * @param string $name
     * @return Container
     * @throws FormException
     */
    public function getContainer($name);

    /**
     * @param string $name
     * @return Aggregator
     * @throws FormException
     */
    public function getAggregator($name);

    /**
     * @param string $name
     * @return Container
     * @throws FormException
     */
    public function getFieldset($name);

    /**
     * @param string $name
     * @return Container
     * @throws FormException
     */
    public function getField($name);

    /**
     * @param string $name
     * @return Container
     * @throws FormException
     */
    public function getRow($name);

    /***************************************************************
     * DEFINE
     **************************************************************/

    /**
     * @param string $name
     * @param int|string $position
     * @return Label
     */
    public function addContent($name,$position = self::POSITION_END);

    /**
     * @param string $name
     * @param int|string $position
     * @return Label
     */
    public function addLabel($name,$position = self::POSITION_END);

    /**
     * @param string $name
     * @param int|string $position
     * @return Html
     */
    public function addHtml($name,$position = self::POSITION_END);

    /**
     * @param string $name
     * @param int|string $position
     * @return HtmlTag
     */
    public function addHtmlTag($name,$position = self::POSITION_END);

    /**
     * @param string $name
     * @param int|string $position
     * @return View
     */
    public function addView($name,$position = self::POSITION_END);

    /**
     * @param string $name
     * @param int|string $position
     * @return Input
     */
    public function addInput($name,$position = self::POSITION_END);
    /**
     * @param string $name
     * @param int|string $position
     * @return Checkbox
     */
    public function addCheckbox($name,$position = self::POSITION_END);

    /**
     * @param string $name
     * @param int|string $position
     * @return Hidden
     */
    public function addHidden($name,$position = self::POSITION_END);

    /**
     * @param string $name
     * @param int|string $position
     * @return Select
     */
    public function addSelect($name,$position = self::POSITION_END);

    /**
     * @param string $name
     * @param int|string $position
     * @return Textarea
     */
    public function addTextarea($name,$position = self::POSITION_END);

    /**
     * @param string $name
     * @param int|string $position
     * @return FileUpload
     */
    public function addFileUpload($name,$position = self::POSITION_END);

    /**
     * @param string $name
     * @param int|string $position
     * @return Button
     */
    public function addButton($name,$position = self::POSITION_END);

    /**
     * @param string $name
     * @param int|string $position
     * @return Container
     */
    public function addContainer($name,$position = self::POSITION_END);

    /**
     * @param string $name
     * @param int|string $position
     * @return Aggregator
     */
    public function addAggregator($name,$position = self::POSITION_END);

    /**
     * @param string $name
     * @param int|string $position
     * @return Container
     */
    public function addFieldset($name,$position = self::POSITION_END);

    /**
     * @param string $name
     * @param int|string $position
     * @return Container
     */
    public function addField($name,$position = self::POSITION_END);

    /**
     * @param string $name
     * @param int|string $position
     * @return Container
     */
    public function addRow($name,$position = self::POSITION_END);

    /***************************************************************
     * USE (import prototypes)
     **************************************************************/

    /**
     * @param string $prototype
     * @param string $as
     * @param int|string $position
     * @return Label
     */
    public function useContent($prototype,$as = null,$position = self::POSITION_END);

    /**
     * @param string $prototype
     * @param string $as
     * @param int|string $position
     * @return Label
     */
    public function useLabel($prototype,$as = null,$position = self::POSITION_END);

    /**
     * @param string $prototype
     * @param string $as
     * @param int|string $position
     * @return Html
     */
    public function useHtml($prototype,$as = null,$position = self::POSITION_END);

    /**
     * @param string $prototype
     * @param string $as
     * @param int|string $position
     * @return HtmlTag
     */
    public function useHtmlTag($prototype,$as = null,$position = self::POSITION_END);

    /**
     * @param string $prototype
     * @param string $as
     * @param int|string $position
     * @return View
     */
    public function useView($prototype,$as = null,$position = self::POSITION_END);

    /**
     * @param string $prototype
     * @param string $as
     * @param int|string $position
     * @return Input
     */
    public function useInput($prototype,$as = null,$position = self::POSITION_END);

    /**
     * @param string $prototype
     * @param string $as
     * @param int|string $position
     * @return Checkbox
     */
    public function useCheckbox($prototype,$as = null,$position = self::POSITION_END);

    /**
     * @param string $prototype
     * @param string $as
     * @param int|string $position
     * @return Select
     */
    public function useSelect($prototype,$as = null,$position = self::POSITION_END);

    /**
     * @param string $prototype
     * @param string $as
     * @param int|string $position
     * @return Textarea
     */
    public function useTextarea($prototype,$as = null,$position = self::POSITION_END);

    /**
     * @param string $prototype
     * @param string $as
     * @param int|string $position
     * @return FileUpload
     */
    public function useFileUpload($prototype,$as = null,$position = self::POSITION_END);

    /**
     * @param string $prototype
     * @param string $as
     * @param int|string $position
     * @return Button
     */
    public function useButton($prototype,$as = null,$position = self::POSITION_END);

    /**
     * @param string $prototype
     * @param string $as
     * @param int|string $position
     * @return Container
     */
    public function useContainer($prototype,$as = null,$position = self::POSITION_END);

    /**
     * @param string $prototype
     * @param string $as
     * @param int|string $position
     * @return Aggregator
     */
    public function useAggregator($prototype,$as = null,$position = self::POSITION_END);

    /**
     * @param string $prototype
     * @param string $as
     * @param int|string $position
     * @return Container
     */
    public function useFieldset($prototype,$as = null,$position = self::POSITION_END);

    /**
     * @param string $prototype
     * @param string $as
     * @param int|string $position
     * @return Container
     */
    public function useField($prototype,$as = null,$position = self::POSITION_END);

    /**
     * @param string $prototype
     * @param string $as
     * @param int|string $position
     * @return Container
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