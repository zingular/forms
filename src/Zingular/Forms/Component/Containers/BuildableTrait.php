<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 13-3-2016
 * Time: 22:10
 */

namespace Zingular\Forms\Component\Containers;
use Zingular\Forms\BaseTypes;
use Zingular\Forms\Component\ComponentInterface;
use Zingular\Forms\Component\Context;
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
 * Class BuildableTrait
 * @package Zingular\Forms\Component\Containers
 */
trait BuildableTrait
{
    /**
     * @return Context
     */
    protected function getContext()
    {
        // implement in adopting class
    }

    /**
     * @param $name
     * @param ComponentInterface $component
     * @param int|string $position
     * @return ComponentInterface
     * @throws FormException
     */
    protected function adopt($name,ComponentInterface $component,$position = -2)
    {
        // implement in adopting class
    }

    /**
     * @param $name
     * @param string $type
     * @return ComponentInterface
     * @throws FormException
     */
    /*
    protected function getComponent($name,$type = null)
    {
        // implement in adopting class
    }
    */

    /***************************************************************
     * GET
     **************************************************************/

    /**
     * @param $name
     * @return Input
     * @throws FormException
     */
    public function getInput($name)
    {
        return $this->getComponent($name,Input::class);
    }

    /**
     * @param $name
     * @return Checkbox
     * @throws FormException
     */
    public function getCheckbox($name)
    {
        return $this->getComponent($name,Checkbox::class);
    }

    /**
     * @param $name
     * @return Select
     * @throws FormException
     */
    public function getSelect($name)
    {
        return $this->getComponent($name,Select::class);
    }

    /**
     * @param $name
     * @return Textarea
     * @throws FormException
     */
    public function getTextarea($name)
    {
        return $this->getComponent($name,Textarea::class);
    }

    /**
     * @param $name
     * @return Button
     * @throws FormException
     */
    public function getButton($name)
    {
        return $this->getComponent($name,Button::class);
    }

    /**
     * @param $name
     * @return Container
     * @throws FormException
     */
    public function getContainer($name)
    {
        return $this->getComponent($name,Container::class);
    }

    /**
     * @param $name
     * @return Aggregator
     * @throws FormException
     */
    public function getAggregator($name)
    {
        return $this->getComponent($name,Aggregator::class);
    }

    /**
     * @param $name
     * @return Container
     * @throws FormException
     */
    public function getFieldset($name)
    {
        //echo $name;

        //var_dump($this->getComponent($name,Fieldset::class));

        //exit;
        return $this->getComponent($name,Fieldset::class);
    }

    /**
     * @param $name
     * @return Container
     * @throws FormException
     */
    public function getField($name)
    {
        return $this->getComponent($name,Field::class);
    }

    /**
     * @param $name
     * @return Row
     * @throws FormException
     */
    public function getRow($name)
    {
        return $this->getComponent($name,Row::class);
    }

    /***************************************************************
     * ADD
     **************************************************************/

    /**
     * @param $name
     * @param $position
     * @param $baseType
     * @return ComponentInterface
     */
    protected function add($name,$position,$baseType)
    {
        return $this->adopt($name,$this->getContext()->getPrototypes()->exportPrototype($baseType),$position);
    }

    /**
     * @param $name
     * @param int|string $position
     * @return Content
     */
    public function addContent($name,$position = -2)
    {
        return $this->add($name,$position,BaseTypes::CONTENT);
    }

    /**
     * @param $name
     * @param int|string $position
     * @return Label
     */
    public function addLabel($name,$position = -2)
    {
        return $this->add($name,$position,BaseTypes::LABEL);
    }

    /**
     * @param $name
     * @param int|string $position
     * @return Html
     */
    public function addHtml($name,$position = -2)
    {
        return $this->add($name,$position,BaseTypes::HTML);
    }

    /**
     * @param $name
     * @param int|string $position
     * @return HtmlTag
     */
    public function addHtmlTag($name,$position = -2)
    {
        return $this->add($name,$position,BaseTypes::HTMLTAG);
    }

    /**
     * @param $name
     * @param int|string $position
     * @return View
     */
    public function addView($name,$position = -2)
    {
        return $this->add($name,$position,BaseTypes::VIEW);
    }

    /**
     * @param $name
     * @param int|string $position
     * @return Input
     */
    public function addInput($name,$position = -2)
    {
        return $this->add($name,$position,BaseTypes::INPUT);
    }


    /**
     * @param $name
     * @param int|string $position
     * @return Checkbox
     */
    public function addCheckbox($name,$position = -2)
    {
        return $this->add($name,$position,BaseTypes::CHECKBOX);
    }

    /**
     * @param $name
     * @param int|string $position
     * @return Hidden
     */
    public function addHidden($name,$position = -2)
    {
        return $this->add($name,$position,BaseTypes::HIDDEN);
    }

    /**
     * @param $name
     * @param int|string $position
     * @return Select
     */
    public function addSelect($name,$position = -2)
    {
        return $this->add($name,$position,BaseTypes::SELECT);
    }

    /**
     * @param $name
     * @param int|string $position
     * @return Textarea
     */
    public function addTextarea($name,$position = -2)
    {
        return $this->add($name,$position,BaseTypes::TEXTAREA);
    }

    /**
     * @param $name
     * @param int|string $position
     * @return Button
     */
    public function addButton($name,$position = -2)
    {
        return $this->add($name,$position,BaseTypes::BUTTON);
    }

    /**
     * @param $name
     * @param int|string $position
     * @return Container
     */
    public function addContainer($name,$position = -2)
    {
        return $this->add($name,$position,BaseTypes::CONTAINER);
    }

    /**
     * @param $name
     * @param int|string $position
     * @return Aggregator
     */
    public function addAggregator($name,$position = -2)
    {
        return $this->add($name,$position,BaseTypes::AGGREGATOR);
    }

    /**
     * @param $name
     * @param int|string $position
     * @return Fieldset
     */
    public function addFieldset($name,$position = -2)
    {
        return $this->add($name,$position,BaseTypes::FIELDSET);
    }

    /**
     * @param $name
     * @param int|string $position
     * @return Container
     */
    public function addField($name,$position = -2)
    {
        return $this->add($name,$position,BaseTypes::FIELD);
    }

    /**
     * @param $name
     * @param int|string $position
     * @return Row
     */
    public function addRow($name, $position = -2)
    {
        return $this->add($name,$position,BaseTypes::ROW);
    }

    /***************************************************************
     * USE (import prototypes)
     **************************************************************/

    /**
     * @param $prototype
     * @param $as
     * @param $baseType
     * @param $baseClass
     * @param int|string $position
     * @return ComponentInterface
     * @throws FormException
     */
    protected function useComponent($prototype,$as,$baseType,$baseClass,$position = -2)
    {
        $as = is_null($as) ? $prototype : $as;
        return $this->adopt($as,$this->getContext()->getPrototypes()->export($baseType,$baseClass,$prototype),$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Label
     */
    public function useContent($prototype,$as = null,$position = -2)
    {
        return $this->useComponent($prototype,$as,BaseTypes::CONTENT,Content::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Label
     */
    public function useLabel($prototype,$as = null,$position = -2)
    {
        return $this->useComponent($prototype,$as,BaseTypes::LABEL,Label::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Html
     */
    public function useHtml($prototype,$as = null,$position = -2)
    {
        return $this->useComponent($prototype,$as,BaseTypes::HTML,Html::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return HtmlTag
     */
    public function useHtmlTag($prototype,$as = null,$position = -2)
    {
        return $this->useComponent($prototype,$as,BaseTypes::HTMLTAG,HtmlTag::class,$position);

    }

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return View
     */
    public function useView($prototype,$as = null,$position = -2)
    {
        return $this->useComponent($prototype,$as,BaseTypes::VIEW,View::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Input
     */
    public function useInput($prototype,$as = null,$position = -2)
    {
        return $this->useComponent($prototype,$as,BaseTypes::INPUT,Input::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Checkbox
     */
    public function useCheckbox($prototype,$as = null,$position = -2)
    {
        return $this->useComponent($prototype,$as,BaseTypes::CHECKBOX,Checkbox::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Select
     */
    public function useSelect($prototype,$as = null,$position = -2)
    {
        return $this->useComponent($prototype,$as,BaseTypes::SELECT,Select::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Textarea
     */
    public function useTextarea($prototype,$as = null,$position = -2)
    {
        return $this->useComponent($prototype,$as,BaseTypes::TEXTAREA,Textarea::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Button
     */
    public function useButton($prototype,$as = null,$position = -2)
    {
        return $this->useComponent($prototype,$as,BaseTypes::BUTTON,Button::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Container
     */
    public function useContainer($prototype,$as = null,$position = -2)
    {
        return $this->useComponent($prototype,$as,BaseTypes::CONTAINER,Container::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Aggregator
     */
    public function useAggregator($prototype,$as = null,$position = -2)
    {
        return $this->useComponent($prototype,$as,BaseTypes::AGGREGATOR,Aggregator::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Fieldset
     */
    public function useFieldset($prototype,$as = null,$position = -2)
    {
        return $this->useComponent($prototype,$as,BaseTypes::FIELDSET,Fieldset::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Field
     */
    public function useField($prototype,$as = null,$position = -2)
    {
        return $this->useComponent($prototype,$as,BaseTypes::FIELD,Field::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Row
     */
    public function useRow($prototype, $as = null, $position = -2)
    {
        return $this->useComponent($prototype,$as,BaseTypes::ROW,Row::class,$position);
    }

    /***************************************************************
     * IMPORT
     **************************************************************/

    /**
     * @param ComponentInterface $component
     * @param string $name
     * @return ComponentInterface
     */
    public function import(ComponentInterface $component,$name)
    {
        return $this->adopt($name,$component);
    }
}