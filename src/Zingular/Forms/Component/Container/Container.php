<?php

namespace Zingular\Forms\Component\Container;

use Zingular\Forms\BaseTypes;
use Zingular\Forms\Component\ComponentInterface;
use Zingular\Forms\Component\ComponentTrait;
use Zingular\Forms\Component\ConditionTrait;
use Zingular\Forms\Component\Context;
use Zingular\Forms\Component\CssTrait;
use Zingular\Forms\Component\DataInterface;
use Zingular\Forms\Component\DataUnitInterface;
use Zingular\Forms\Component\Element\Content\Content;
use Zingular\Forms\Component\Element\Content\ContentInterface;
use Zingular\Forms\Component\Element\Content\Html;
use Zingular\Forms\Component\Element\Content\HtmlTag;
use Zingular\Forms\Component\Element\Content\Label;
use Zingular\Forms\Component\Element\Content\View;
use Zingular\Forms\Component\Element\Control\AbstractControl;
use Zingular\Forms\Component\Element\Control\Button;
use Zingular\Forms\Component\Element\Control\Checkbox;
use Zingular\Forms\Component\Element\Control\Hidden;
use Zingular\Forms\Component\Element\Control\Input;
use Zingular\Forms\Component\Element\Control\Select;
use Zingular\Forms\Component\Element\Control\Textarea;
use Zingular\Forms\Component\FormContext;
use Zingular\Forms\Component\CssComponentInterface;
use Zingular\Forms\Component\HtmlAttributesTrait;
use Zingular\Forms\Component\ServiceGetterInterface;
use Zingular\Forms\Component\ViewableComponentInterface;
use Zingular\Forms\Component\ViewSetterTrait;
use Zingular\Forms\ErrorBuilder;
use Zingular\Forms\Exception\FormException;
use Zingular\Forms\Plugins\Builders\Container\RuntimeBuilderInterface;
use Zingular\Forms\Plugins\Builders\Error\ErrorBuilderInterface;
use Zingular\Forms\Plugins\Builders\Options\OptionsBuilder;
use Zingular\Forms\Plugins\Builders\Container\BuilderInterface;


/**
 * Class Container
 * @package Zingular\Form
 */
class Container extends AbstractContainer implements DataInterface,BuildableInterface,CssComponentInterface,ViewableComponentInterface
{
    use ComponentTrait;
    use ViewSetterTrait;
    use CssTrait;
    use ConditionTrait;
    use HtmlAttributesTrait;

    /**
     * @var RuntimeBuilderInterface
     */
    protected $preBuilder;

    /**
     * @var RuntimeBuilderInterface
     */
    protected $postBuilder;

    /**
     * @var array
     */
    protected $builderTypes = array();

    /**
     * @var string
     */
    protected $errorBuilder = ErrorBuilder::STANDARD;

    /**
     * @var array
     */
    protected $values = array();

    /**
     * @var array
     */
    protected $errors = array();

    /**
     * @var bool
     */
    protected $showErrors = true;

    /**
     * @var array
     */
    protected $adoptionHistory;

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
     * @param string $position
     * @return ComponentInterface
     * @throws FormException
     */
    protected function adopt($name,ComponentInterface $component,$position = self::END)
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

    /***************************************************************
     * DATA
     **************************************************************/

    /**
     * @return array
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @return string
     */
    public function getDataPath()
    {
        // simply return the data path of the parent (don't add anything)
        return $this->context->getDataPath();
    }

    /***************************************************************
     * DEFINE
     **************************************************************/

    /**
     * @param $name
     * @param $position
     * @param $baseType
     * @return ComponentInterface
     */
    protected function add($name,$position,$baseType)
    {
        return $this->adopt($name,$this->context->getPrototypes()->exportPrototype($baseType),$position);
    }

    /**
     * @param $name
     * @param string $position
     * @return Label
     */
    public function addContent($name,$position = self::END)
    {
        return $this->add($name,$position,BaseTypes::CONTENT);
    }

    /**
     * @param $name
     * @param string $position
     * @return Label
     */
    public function addLabel($name,$position = self::END)
    {
        return $this->add($name,$position,BaseTypes::LABEL);
    }

    /**
     * @param $name
     * @param string $position
     * @return Html
     */
    public function addHtml($name,$position = self::END)
    {
        return $this->add($name,$position,BaseTypes::HTML);
    }

    /**
     * @param $name
     * @param string $position
     * @return HtmlTag
     */
    public function addHtmlTag($name,$position = self::END)
    {
        return $this->add($name,$position,BaseTypes::HTMLTAG);
    }

    /**
     * @param $name
     * @param string $position
     * @return View
     */
    public function addView($name,$position = self::END)
    {
        return $this->add($name,$position,BaseTypes::VIEW);
    }

    /**
     * @param $name
     * @param string $position
     * @return Input
     */
    public function addInput($name,$position = self::END)
    {
        return $this->add($name,$position,BaseTypes::INPUT);
    }


    /**
     * @param $name
     * @param string $position
     * @return Checkbox
     */
    public function addCheckbox($name,$position = self::END)
    {
        return $this->add($name,$position,BaseTypes::CHECKBOX);
    }

    /**
     * @param $name
     * @param string $position
     * @return Hidden
     */
    public function addHidden($name,$position = self::END)
    {
        return $this->add($name,$position,BaseTypes::HIDDEN);
    }

    /**
     * @param $name
     * @param string $position
     * @return Select
     */
    public function addSelect($name,$position = self::END)
    {
        return $this->add($name,$position,BaseTypes::SELECT);
    }

    /**
     * @param $name
     * @param string $position
     * @return Textarea
     */
    public function addTextarea($name,$position = self::END)
    {
        return $this->add($name,$position,BaseTypes::TEXTAREA);
    }

    /**
     * @param $name
     * @param string $position
     * @return Button
     */
    public function addButton($name,$position = self::END)
    {
        return $this->add($name,$position,BaseTypes::BUTTON);
    }

    /**
     * @param $name
     * @param string $position
     * @return Container
     */
    public function addContainer($name,$position = self::END)
    {
        return $this->add($name,$position,BaseTypes::CONTAINER);
    }

    /**
     * @param $name
     * @param string $position
     * @return Aggregator
     */
    public function addAggregator($name,$position = self::END)
    {
        return $this->add($name,$position,BaseTypes::AGGREGATOR);
    }

    /**
     * @param $name
     * @param string $position
     * @return Fieldset
     */
    public function addFieldset($name,$position = self::END)
    {
        return $this->add($name,$position,BaseTypes::FIELDSET);
    }

    /**
     * @param $name
     * @param string $position
     * @return Container
     */
    public function addField($name,$position = self::END)
    {
        return $this->add($name,$position,BaseTypes::FIELD);
    }

    /**
     * @param $name
     * @param string $position
     * @return Row
     */
    public function addRow($name, $position = self::END)
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
     * @param string $position
     * @return ComponentInterface
     * @throws FormException
     */
    protected function useComponent($prototype,$as,$baseType,$baseClass,$position = self::END)
    {
        $as = is_null($as) ? $prototype : $as;
        return $this->adopt($as,$this->context->getPrototypes()->export($baseType,$baseClass,$prototype),$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param string $position
     * @return Label
     */
    public function useContent($prototype,$as = null,$position = self::END)
    {
        return $this->useComponent($prototype,$as,BaseTypes::CONTENT,Content::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param string $position
     * @return Label
     */
    public function useLabel($prototype,$as = null,$position = self::END)
    {
        return $this->useComponent($prototype,$as,BaseTypes::LABEL,Label::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param string $position
     * @return Html
     */
    public function useHtml($prototype,$as = null,$position = self::END)
    {
        return $this->useComponent($prototype,$as,BaseTypes::HTML,Html::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param string $position
     * @return HtmlTag
     */
    public function useHtmlTag($prototype,$as = null,$position = self::END)
    {
        return $this->useComponent($prototype,$as,BaseTypes::HTMLTAG,HtmlTag::class,$position);

    }

    /**
     * @param $prototype
     * @param null $as
     * @param string $position
     * @return View
     */
    public function useView($prototype,$as = null,$position = self::END)
    {
        return $this->useComponent($prototype,$as,BaseTypes::VIEW,View::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param string $position
     * @return Input
     */
    public function useInput($prototype,$as = null,$position = self::END)
    {
        return $this->useComponent($prototype,$as,BaseTypes::INPUT,Input::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param string $position
     * @return Checkbox
     */
    public function useCheckbox($prototype,$as = null,$position = self::END)
    {
        return $this->useComponent($prototype,$as,BaseTypes::CHECKBOX,Checkbox::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param string $position
     * @return Select
     */
    public function useSelect($prototype,$as = null,$position = self::END)
    {
        return $this->useComponent($prototype,$as,BaseTypes::SELECT,Select::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param string $position
     * @return Textarea
     */
    public function useTextarea($prototype,$as = null,$position = self::END)
    {
        return $this->useComponent($prototype,$as,BaseTypes::TEXTAREA,Textarea::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param string $position
     * @return Button
     */
    public function useButton($prototype,$as = null,$position = self::END)
    {
        return $this->useComponent($prototype,$as,BaseTypes::BUTTON,Button::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param string $position
     * @return Container
     */
    public function useContainer($prototype,$as = null,$position = self::END)
    {
        return $this->useComponent($prototype,$as,BaseTypes::CONTAINER,Container::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param string $position
     * @return Aggregator
     */
    public function useAggregator($prototype,$as = null,$position = self::END)
    {
        return $this->useComponent($prototype,$as,BaseTypes::AGGREGATOR,Aggregator::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param string $position
     * @return Fieldset
     */
    public function useFieldset($prototype,$as = null,$position = self::END)
    {
        return $this->useComponent($prototype,$as,BaseTypes::FIELDSET,Fieldset::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param string $position
     * @return Field
     */
    public function useField($prototype,$as = null,$position = self::END)
    {
        return $this->useComponent($prototype,$as,BaseTypes::FIELD,Field::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param string $position
     * @return Row
     */
    public function useRow($prototype, $as = null, $position = self::END)
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

    /***************************************************************
     * BUILDING
     **************************************************************/

    /**
     * @param $builder
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
     * @param string|ErrorBuilderInterface $builder
     */
    public function setErrorBuilder($builder)
    {
        $this->errorBuilder = $builder;
    }

    /**
     * @param string|\Zingular\Forms\Plugins\Builders\Container\RuntimeBuilderInterface $builder
     * @return $this
     */
    public function addBuilder($builder)
    {
        $this->builderTypes[] = $builder;
        return $this;
    }

    /**
     * @param \Zingular\Forms\Plugins\Builders\Container\BuilderInterface $builder
     */
    public function applyBuilder(BuilderInterface $builder)
    {
        $builder->build($this);
    }

    /**
     * @param string|\Zingular\Forms\Plugins\Builders\Container\RuntimeBuilderInterface|callable $builder
     * @throws FormException
     */
    protected function applyBuilderType($builder)
    {
        // builder is a type string, create a builder from it using the factory
        if(is_string($builder))
        {
            $this->getServices()->getBuilders()->get($builder)->build($this,$this->formContext);
        }
        elseif($builder instanceof RuntimeBuilderInterface)
        {
            $builder->build($this,$this->formContext);
        }
        elseif(is_callable($builder))
        {
            call_user_func($builder,$this);
        }
        else
        {
            throw new FormException(sprintf("Incorrect builder argument type (should be one of: string, RuntimeBuilderInterface, callable, got '%s')",is_object($builder) ? get_class($builder) : gettype($builder)));
        }
    }

    /**
     * @param array|RuntimeBuilderInterface|callable $options
     * @return $this
     */
    public function setOptions($options)
    {
        $this->builderTypes[] = new OptionsBuilder($options);
        return $this;
    }

    /***************************************************************
     * COMPILATION
     **************************************************************/

    /**
     * @param FormContext $formContext
     * @param array $defaultValues
     * @throws FormException
     */
    public function compile(FormContext $formContext,array $defaultValues = array())
    {
        // set the form context locally
        $this->formContext = $formContext;

        // perform hard-coded pre-buildPrototypes actions
        $this->preBuild($formContext);

        // apply prebuilder
        if(!is_null($this->preBuilder))
        {
            $this->applyBuilderType($this->preBuilder);
        }

        // preBuild using the set builder
        foreach($this->builderTypes as $builder)
        {
            $this->applyBuilderType($builder);
        }

        // compile children
        $this->compileChildren($this->components,$formContext,$defaultValues);

        // init the adoption history
        $this->adoptionHistory = array();

        // apply postbuilder (after all nested, recursive children are built, and values are collected, cannot add data components anymore!)
        if(!is_null($this->postBuilder))
        {
            $this->applyBuilderType($this->postBuilder);
        }

        // perform hard-coded post-buildPrototypes actions
        $this->postBuild($formContext);

        // compile any newly adopted children during post-build
        $this->compileChildren($this->adoptionHistory,$formContext,$defaultValues);

        // reset the adoption history
        $this->adoptionHistory = null;

        // process any errors found during compilation
        $this->processErrors();
    }

    /**
     * @param array $children
     * @param FormContext $formContext
     * @param array $defaultValues
     */
    protected function compileChildren(array $children,FormContext $formContext,array $defaultValues = array())
    {
        foreach($children as $component)
        {
            if($component instanceof ComponentInterface)
            {
                // check display conditions, and if fails, remove child, and continue
                // TODO

                // compile the child component
                try
                {
                    if($component instanceof DataInterface)
                    {
                        $component->compile($formContext,$defaultValues);
                    }
                    elseif($component instanceof ContentInterface)
                    {
                        $component->compile($formContext);
                    }
                }
                // catch any errors during child compilation
                catch(\Exception $e)
                {
                    if($component instanceof CssComponentInterface)
                    {
                        $component->addCssClass('error');
                    }

                    $this->errors[] = $e;
                }

                // collect the values of the child component
                if($component instanceof DataInterface)
                {
                    $this->collectValues($component);
                }
            }
        }
    }

    /**
     * @param DataInterface $child
     */
    protected function collectValues(DataInterface $child)
    {
        // if the component is a data unit
        if($child instanceof DataUnitInterface)
        {
            // if its value should be ignored, return
            if($child->shouldIgnoreValue())
            {
                return;
            }

            // add the value of the component to the values of this container
            $this->values[$child->getName()] = $child->getValue();
        }
        // if the component itself is a container, merge its values with the current values
        elseif($child instanceof Container)
        {
            $this->values = array_merge($this->values,$child->getValues());
        }
    }

    /**
     * Optionally perform mandatory, container type-specific preBuild operations
     * @param FormContext $context
     */
    protected function preBuild(FormContext $context) {}

    /**
     * @param FormContext $context
     */
    protected function postBuild(FormContext $context) {}

    /**
     *
     */
    protected function processErrors()
    {
        if($this->showErrors && count($this->errors))
        {
            // mark this container to have errors
            $this->addCssClass('errorContainer');

            // create the builder
            $builder = $this->getServices()->getErrorBuilderFactory()->create($this->errorBuilder);

            // buildPrototypes errors
            $builder->build($this,$this->formContext,$this->errors);
        }
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        // TODO: merge with errors of child containers i.c.w. showErrors
        return $this->errors;
    }

    /**
     * @return bool
     */
    public function hasErrors()
    {
        return count($this->errors) > 0;
    }

    /**
     * @param bool $set
     * @return $this
     */
    public function showErrors($set = true)
    {
        $this->showErrors = $set;
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
            'children'=>array()
        );
    }


    /**
     * @param int $level
     * @return Container
     */
    public function close($level = 1)
    {
        return $this->getParent($level);
    }

    /***************************************************************
     * CONTEXT
     **************************************************************/

    /**
     * @param Context $context
     */
    public function setContext(Context $context)
    {
        $this->context = $context;
    }

    /**
     * @param $id
     * @return Context
     */
    protected function createContext($id)
    {
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
        if(!is_null($this->formContext))
        {
            throw new FormException(sprintf("Cannot clone component during form processing: '%s'",$this->getId()));
        }

        // call parent clone to clone all children
        parent::__clone();

        // unset the current context
        $this->context = null;
    }

    /**
     * @return ServiceGetterInterface
     */
    protected function getServices()
    {
        return $this->formContext->getServices();
    }
}