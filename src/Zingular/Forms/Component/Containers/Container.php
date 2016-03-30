<?php

namespace Zingular\Forms\Component\Containers;

use Zingular\Forms\BaseTypes;
use Zingular\Forms\Component\ComponentInterface;
use Zingular\Forms\Component\ComponentTrait;
use Zingular\Forms\Component\ConditionableInterface;
use Zingular\Forms\Component\ConditionableTrait;
use Zingular\Forms\Component\Context\Context;
use Zingular\Forms\Component\CssComponentTrait;
use Zingular\Forms\Component\Elements\Contents\Content;
use Zingular\Forms\Component\Elements\Contents\Html;
use Zingular\Forms\Component\Elements\Contents\HtmlTag;
use Zingular\Forms\Component\Elements\Contents\Label;
use Zingular\Forms\Component\Elements\Contents\View;
use Zingular\Forms\Component\Elements\Controls\AbstractControl;
use Zingular\Forms\Component\Elements\Controls\Button;
use Zingular\Forms\Component\Elements\Controls\Checkbox;
use Zingular\Forms\Component\Elements\Controls\FileUpload;
use Zingular\Forms\Component\Elements\Controls\Hidden;
use Zingular\Forms\Component\Elements\Controls\Input;
use Zingular\Forms\Component\Elements\Controls\Select;
use Zingular\Forms\Component\Elements\Controls\Textarea;
use Zingular\Forms\Component\CssComponentInterface;
use Zingular\Forms\Component\HtmlAttributesTrait;
use Zingular\Forms\Component\TranslatableComponentInterface;
use Zingular\Forms\Component\TypedComponentInterface;
use Zingular\Forms\Component\TypedComponentTrait;
use Zingular\Forms\Events\EventDispatcherTrait;
use Zingular\Forms\OptionMode;
use Zingular\Forms\Plugins\Builders\Options\OptionsProvider;
use Zingular\Forms\Plugins\Conditions\ConditionGroup;
use Zingular\Forms\Component\ViewableComponentInterface;
use Zingular\Forms\Component\ViewSetterTrait;
use Zingular\Forms\Exception\FormException;
use Zingular\Forms\Plugins\Builders\Container\BuilderInterface;
use Zingular\Forms\Plugins\Builders\Container\SimpleBuilderInterface;

/**
 * Class Container
 * @package Zingular\Form
 */
class Container extends AbstractContainer implements
    BuildableInterface,
    CssComponentInterface,
    ViewableComponentInterface,
    ConditionableInterface,
    ErrorContainerInterface,
    TranslatableComponentInterface,
    TypedComponentInterface
{
    use ComponentTrait;
    use ViewSetterTrait;
    use CssComponentTrait;
    use HtmlAttributesTrait;
    use ConditionableTrait;
    use EventDispatcherTrait;
    use TypedComponentTrait;

    /**
     * @var string
     */
    protected $translationKey = '{parentId}.{id}';

    /**
     * @var BuilderInterface
     */
    protected $preBuilder;

    /**
     * @var BuilderInterface
     */
    protected $postBuilder;

    /**
     * @var array
     */
    protected $builderTypes = array();

    /**
     * @var string
     */
    protected $errorBuilder;

    /**
     * @var array
     */
    protected $errors = array();

    /**
     * @var bool
     */
    protected $showErrors = self::ERRORS_CHILDREN;

    /**
     * @var array
     */
    protected $adoptionHistory;

    /**
     * @var OptionsProvider
     */
    protected $optionsProvider;

    /**
     * @return array
     */
    public function getComponents()
    {
        return $this->components;
    }

    /**
     * @return AbstractControl
     */
    public function getFirstControl()
    {
        foreach($this->components as $component)
        {
            if($component instanceof Container)
            {
                $control = $component->getFirstControl();

                if(!is_null($control))
                {
                    return $control;
                }
            }
            elseif($component instanceof AbstractControl)
            {
                return $component;
            }
        }
        return null;
    }

    /**
     * @param $name
     * @param ComponentInterface $component
     * @param int|string $position
     * @return ComponentInterface
     * @throws FormException
     */
    protected function adopt($name,ComponentInterface $component,$position = self::POSITION_END)
    {
        // add using parent method
        $component = parent::adopt($name,$component,$position);

        // also add a css class for the instance name
        if($component instanceof CssComponentInterface)
        {
            $component->addCssClass($name);
        }

        // add component to adoption history
        if(is_array($this->adoptionHistory))
        {
            $this->adoptionHistory[] = $component;
        }

        // return component
        return $component;
    }

    /**
     * @return Context
     */
    protected function getContext()
    {
        return $this->context;
    }

    /***************************************************************
     * TRANSLATION
     **************************************************************/

    /**
     * @param string $key
     * @return $this
     */
    public function setTranslationKey($key)
    {
        $this->translationKey = $key;
        return $this;
    }

    /**
     * @return string
     */
    public function getTranslationKey()
    {
        return $this->translationKey;
    }

    /***************************************************************
     * BUILDING
     **************************************************************/

    /**
     * @param string|SimpleBuilderInterface|BuilderInterface|callable $builder
     * @param bool $post
     * @return $this
     */
    public function setBuilder($builder = null,$post = false)
    {
        if($post)
        {
            $this->postBuilder = $builder;
        }
        else
        {
            $this->preBuilder = $builder;
        }

        return $this;
    }

    /**
     * @param string|SimpleBuilderInterface|BuilderInterface|callable $builder
     */
    public function setErrorBuilder($builder)
    {
        $this->errorBuilder = $builder;
    }

    /**
     * @param string|SimpleBuilderInterface|BuilderInterface|callable $builder
     * @return $this
     */
    public function addBuilder($builder)
    {
        $this->builderTypes[] = $builder;
        return $this;
    }

    /**
     * @param array|callable $options
     * @param string $mode
     * @return $this
     */
    public function setOptions($options,$mode = OptionMode::MODE_KEYS_VALUES)
    {
        $this->optionsProvider = new OptionsProvider($options,$mode);
        return $this;
    }

    /**
     * @param bool $recursive
     * @return array
     */
    public function getErrors($recursive = false)
    {
        // TODO: merge with errors of child containers i.c.w. showErrors
        return $this->errors;
    }

    /**
     * @param bool $recursive
     * @return bool
     */
    public function hasErrors($recursive = false)
    {
        if($recursive)
        {

        }

        return count($this->errors) > 0;
    }

    /**
     * @param $show
     * @return string|bool
     */
    public function showErrors($show = self::ERRORS_CHILDREN)
    {
        if(is_bool($show))
        {
            $show = $show ? self::ERRORS_CHILDREN : self::ERRORS_NONE;
        }

        $this->showErrors = $show;
        return $this;
    }

    /***************************************************************
     * VIEW
     **************************************************************/

    /**
     * @return array
     */
    protected function describeSelf()
    {
        return array
        (
            'fullName'=>$this->getId(),
            'type'=>get_class($this),
            'builders'=>$this->builderTypes,
            'view'=>$this->viewName,
            'children'=>array(),
            'conditions'=>count($this->conditionGroups)
        );
    }

    /***************************************************************
     * CONTEXT
     **************************************************************/

    /**
     * @param $id
     * @return Context
     */
    protected function createContext($id)
    {
        // create a new context with this container as parent, and inherit this containers prototypes
        return new Context($id,$this,$this->context->getPrototypes());
    }

    /***************************************************************
     * INTERNAL
     **************************************************************/

    /**
     *
     */
    public function __clone()
    {
        // cannot clone a container when it is already used in a form runtime
        if(!is_null($this->state))
        {
            throw new FormException(sprintf("Cannot clone component during form processing: '%s'",$this->getId()));
        }

        // call parent clone to clone all children
        parent::__clone();

        // clear adoption history
        $this->adoptionHistory = null;

        // clear any runtime errors
        $this->errors = array();

        // unset the current context
        $this->context = null;
    }

    /***************************************************************
     * CONDITIONABLE
     **************************************************************/

    /**
     * @param $condition
     * @param ...$params
     * @return static
     */
    public function ifCondition($condition, ...$params)
    {
        // create a new condition group
        $group = new ConditionGroup($this,$condition,$params,count($this->components));

        // add the condition group to the conditions list
        $this->conditionGroups[] = $group;

        // return the condition group
        return $group;
    }


    /***************************************************************
     * GET
     **************************************************************/

    /**
     * @param string $name
     * @return Input
     * @throws FormException
     */
    public function getInput($name)
    {
        return $this->getComponent($name,Input::class);
    }

    /**
     * @param string $name
     * @return Checkbox
     * @throws FormException
     */
    public function getCheckbox($name)
    {
        return $this->getComponent($name,Checkbox::class);
    }

    /**
     * @param string $name
     * @return Select
     * @throws FormException
     */
    public function getSelect($name)
    {
        return $this->getComponent($name,Select::class);
    }

    /**
     * @param string $name
     * @return Textarea
     * @throws FormException
     */
    public function getTextarea($name)
    {
        return $this->getComponent($name,Textarea::class);
    }

    /**
     * @param string $name
     * @return FileUpload
     * @throws FormException
     */
    public function getFileUpload($name)
    {
        return $this->getComponent($name,FileUpload::class);
    }

    /**
     * @param string $name
     * @return Button
     * @throws FormException
     */
    public function getButton($name)
    {
        return $this->getComponent($name,Button::class);
    }

    /**
     * @param string $name
     * @return Container
     * @throws FormException
     */
    public function getContainer($name)
    {
        return $this->getComponent($name,Container::class);
    }

    /**
     * @param string $name
     * @return Aggregator
     * @throws FormException
     */
    public function getAggregator($name)
    {
        return $this->getComponent($name,Aggregator::class);
    }

    /**
     * @param string $name
     * @return Container
     * @throws FormException
     */
    public function getFieldset($name)
    {
        return $this->getComponent($name,Container::class);
    }

    /**
     * @param string $name
     * @return Container
     * @throws FormException
     */
    public function getField($name)
    {
        return $this->getComponent($name,Container::class);
    }

    /**
     * @param string $name
     * @return Container
     * @throws FormException
     */
    public function getRow($name)
    {
        return $this->getComponent($name,Container::class);
    }

    /***************************************************************
     * ADD
     **************************************************************/

    /**
     * @param string $name
     * @param int|string $position
     * @param string $baseType
     * @return ComponentInterface
     */
    protected function add($name,$position,$baseType)
    {
        return $this->adopt($name,$this->getContext()->getPrototypes()->exportPrototype($baseType),$position);
    }

    /**
     * @param string $name
     * @param int|string $position
     * @return Content
     */
    public function addContent($name,$position = self::POSITION_END)
    {
        return $this->add($name,$position,BaseTypes::CONTENT);
    }

    /**
     * @param string $name
     * @param int|string $position
     * @return Label
     */
    public function addLabel($name,$position = self::POSITION_END)
    {
        return $this->add($name,$position,BaseTypes::LABEL);
    }

    /**
     * @param string $name
     * @param int|string $position
     * @return Html
     */
    public function addHtml($name,$position = self::POSITION_END)
    {
        return $this->add($name,$position,BaseTypes::HTML);
    }

    /**
     * @param string $name
     * @param int|string $position
     * @return HtmlTag
     */
    public function addHtmlTag($name,$position = self::POSITION_END)
    {
        return $this->add($name,$position,BaseTypes::HTMLTAG);
    }

    /**
     * @param string $name
     * @param int|string $position
     * @return View
     */
    public function addView($name,$position = self::POSITION_END)
    {
        return $this->add($name,$position,BaseTypes::VIEW);
    }

    /**
     * @param string $name
     * @param int|string $position
     * @return Input
     */
    public function addInput($name,$position = self::POSITION_END)
    {
        return $this->add($name,$position,BaseTypes::INPUT);
    }


    /**
     * @param string $name
     * @param int|string $position
     * @return Checkbox
     */
    public function addCheckbox($name,$position = self::POSITION_END)
    {
        return $this->add($name,$position,BaseTypes::CHECKBOX);
    }

    /**
     * @param string $name
     * @param int|string $position
     * @return Hidden
     */
    public function addHidden($name,$position = self::POSITION_END)
    {
        return $this->add($name,$position,BaseTypes::HIDDEN);
    }

    /**
     * @param string $name
     * @param int|string $position
     * @return Select
     */
    public function addSelect($name,$position = self::POSITION_END)
    {
        return $this->add($name,$position,BaseTypes::SELECT);
    }

    /**
     * @param string $name
     * @param int|string $position
     * @return Textarea
     */
    public function addTextarea($name,$position = self::POSITION_END)
    {
        return $this->add($name,$position,BaseTypes::TEXTAREA);
    }

    /**
     * @param string $name
     * @param int|string $position
     * @return FileUpload
     */
    public function addFileUpload($name,$position = self::POSITION_END)
    {
        return $this->add($name,$position,BaseTypes::FILE_UPLOAD);
    }

    /**
     * @param string $name
     * @param int|string $position
     * @return Button
     */
    public function addButton($name,$position = self::POSITION_END)
    {
        return $this->add($name,$position,BaseTypes::BUTTON);
    }

    /**
     * @param string $name
     * @param int|string $position
     * @return Container
     */
    public function addContainer($name,$position = self::POSITION_END)
    {
        return $this->add($name,$position,BaseTypes::CONTAINER);
    }

    /**
     * @param string $name
     * @param int|string $position
     * @return Aggregator
     */
    public function addAggregator($name,$position = self::POSITION_END)
    {
        return $this->add($name,$position,BaseTypes::AGGREGATOR);
    }

    /**
     * @param string $name
     * @param int|string $position
     * @return Container
     */
    public function addFieldset($name,$position = self::POSITION_END)
    {
        return $this->add($name,$position,BaseTypes::FIELDSET);
    }

    /**
     * @param string $name
     * @param int|string $position
     * @return Container
     */
    public function addField($name,$position = self::POSITION_END)
    {
        return $this->add($name,$position,BaseTypes::FIELD);
    }

    /**
     * @param string $name
     * @param int|string $position
     * @return Container
     */
    public function addRow($name, $position = self::POSITION_END)
    {
        return $this->add($name,$position,BaseTypes::ROW);
    }

    /***************************************************************
     * USE (import prototypes)
     **************************************************************/

    /**
     * @param string $prototype
     * @param string $as
     * @param $baseType
     * @param $baseClass
     * @param int|string $position
     * @return ComponentInterface
     * @throws FormException
     */
    protected function useComponent($prototype,$as,$baseType,$baseClass,$position = self::POSITION_END)
    {
        $as = is_null($as) ? $prototype : $as;
        return $this->adopt($as,$this->getContext()->getPrototypes()->export($baseType,$baseClass,$prototype),$position);
    }

    /**
     * @param string $prototype
     * @param string $as
     * @param int|string $position
     * @return Label
     */
    public function useContent($prototype,$as = null,$position = self::POSITION_END)
    {
        return $this->useComponent($prototype,$as,BaseTypes::CONTENT,Content::class,$position);
    }

    /**
     * @param string $prototype
     * @param string $as
     * @param int|string $position
     * @return Label
     */
    public function useLabel($prototype,$as = null,$position = self::POSITION_END)
    {
        return $this->useComponent($prototype,$as,BaseTypes::LABEL,Label::class,$position);
    }

    /**
     * @param string $prototype
     * @param string $as
     * @param int|string $position
     * @return Html
     */
    public function useHtml($prototype,$as = null,$position = self::POSITION_END)
    {
        return $this->useComponent($prototype,$as,BaseTypes::HTML,Html::class,$position);
    }

    /**
     * @param string $prototype
     * @param string $as
     * @param int|string $position
     * @return HtmlTag
     */
    public function useHtmlTag($prototype,$as = null,$position = self::POSITION_END)
    {
        return $this->useComponent($prototype,$as,BaseTypes::HTMLTAG,HtmlTag::class,$position);

    }

    /**
     * @param string $prototype
     * @param string $as
     * @param int|string $position
     * @return View
     */
    public function useView($prototype,$as = null,$position = self::POSITION_END)
    {
        return $this->useComponent($prototype,$as,BaseTypes::VIEW,View::class,$position);
    }

    /**
     * @param string $prototype
     * @param string $as
     * @param int|string $position
     * @return Input
     */
    public function useInput($prototype,$as = null,$position = self::POSITION_END)
    {
        return $this->useComponent($prototype,$as,BaseTypes::INPUT,Input::class,$position);
    }

    /**
     * @param string $prototype
     * @param string $as
     * @param int|string $position
     * @return Checkbox
     */
    public function useCheckbox($prototype,$as = null,$position = self::POSITION_END)
    {
        return $this->useComponent($prototype,$as,BaseTypes::CHECKBOX,Checkbox::class,$position);
    }

    /**
     * @param string $prototype
     * @param string $as
     * @param int|string $position
     * @return Select
     */
    public function useSelect($prototype,$as = null,$position = self::POSITION_END)
    {
        return $this->useComponent($prototype,$as,BaseTypes::SELECT,Select::class,$position);
    }

    /**
     * @param string $prototype
     * @param string $as
     * @param int|string $position
     * @return Textarea
     */
    public function useTextarea($prototype,$as = null,$position = self::POSITION_END)
    {
        return $this->useComponent($prototype,$as,BaseTypes::TEXTAREA,Textarea::class,$position);
    }

    /**
     * @param string $prototype
     * @param string $as
     * @param int|string $position
     * @return FileUpload
     */
    public function useFileUpload($prototype,$as = null,$position = self::POSITION_END)
    {
        return $this->useComponent($prototype,$as,BaseTypes::FILE_UPLOAD,FileUpload::class,$position);
    }

    /**
     * @param string $prototype
     * @param string $as
     * @param int|string $position
     * @return Button
     */
    public function useButton($prototype,$as = null,$position = self::POSITION_END)
    {
        return $this->useComponent($prototype,$as,BaseTypes::BUTTON,Button::class,$position);
    }

    /**
     * @param string $prototype
     * @param string $as
     * @param int|string $position
     * @return Container
     */
    public function useContainer($prototype,$as = null,$position = self::POSITION_END)
    {
        return $this->useComponent($prototype,$as,BaseTypes::CONTAINER,Container::class,$position);
    }

    /**
     * @param string $prototype
     * @param string $as
     * @param int|string $position
     * @return Aggregator
     */
    public function useAggregator($prototype,$as = null,$position = self::POSITION_END)
    {
        return $this->useComponent($prototype,$as,BaseTypes::AGGREGATOR,Aggregator::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Container
     */
    public function useFieldset($prototype,$as = null,$position = self::POSITION_END)
    {
        return $this->useComponent($prototype,$as,BaseTypes::FIELDSET,Container::class,$position);
    }

    /**
     * @param string $prototype
     * @param string $as
     * @param int|string $position
     * @return Container
     */
    public function useField($prototype,$as = null,$position = self::POSITION_END)
    {
        return $this->useComponent($prototype,$as,BaseTypes::FIELD,Container::class,$position);
    }

    /**
     * @param string $prototype
     * @param string $as
     * @param int|string $position
     * @return Container
     */
    public function useRow($prototype, $as = null, $position = self::POSITION_END)
    {
        return $this->useComponent($prototype,$as,BaseTypes::ROW,Container::class,$position);
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