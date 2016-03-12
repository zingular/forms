<?php

namespace Zingular\Forms\Component\Containers;

use Zingular\Forms\BaseTypes;
use Zingular\Forms\Builder;
use Zingular\Forms\Component\ComponentInterface;
use Zingular\Forms\Component\ComponentTrait;
use Zingular\Forms\Component\ConditionableInterface;
use Zingular\Forms\Component\ConditionableTrait;
use Zingular\Forms\Component\Context;
use Zingular\Forms\Component\CssComponentTrait;
use Zingular\Forms\Component\DataInterface;
use Zingular\Forms\Component\DataUnitInterface;
use Zingular\Forms\Component\Elements\Contents\Content;
use Zingular\Forms\Component\Elements\Contents\ContentInterface;
use Zingular\Forms\Component\Elements\Contents\Html;
use Zingular\Forms\Component\Elements\Contents\HtmlTag;
use Zingular\Forms\Component\Elements\Contents\Label;
use Zingular\Forms\Component\Elements\Contents\View;
use Zingular\Forms\Component\Elements\Controls\AbstractControl;
use Zingular\Forms\Component\Elements\Controls\Button;
use Zingular\Forms\Component\Elements\Controls\Checkbox;
use Zingular\Forms\Component\Elements\Controls\Hidden;
use Zingular\Forms\Component\Elements\Controls\Input;
use Zingular\Forms\Component\Elements\Controls\Select;
use Zingular\Forms\Component\Elements\Controls\Textarea;
use Zingular\Forms\Component\FormState;
use Zingular\Forms\Component\CssComponentInterface;
use Zingular\Forms\Component\HtmlAttributesTrait;
use Zingular\Forms\Service\ServiceGetterInterface;
use Zingular\Forms\Component\ViewableComponentInterface;
use Zingular\Forms\Component\ViewSetterTrait;
use Zingular\Forms\Exception\FormException;
use Zingular\Forms\Plugins\Builders\Container\RuntimeBuilderInterface;
use Zingular\Forms\Plugins\Builders\Options\OptionsBuilder;
use Zingular\Forms\Plugins\Builders\Container\BuilderInterface;


/**
 * Class Container
 * @package Zingular\Form
 */
class Container extends AbstractContainer implements
    DataInterface,
    BuildableInterface,
    CssComponentInterface,
    ViewableComponentInterface,
    ConditionableInterface
{
    use ComponentTrait;
    use ViewSetterTrait;
    use CssComponentTrait;
    use HtmlAttributesTrait;
    use ConditionableTrait;

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
    protected $errorBuilder = Builder::ERROR;

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
     * @param int|string $position
     * @return ComponentInterface
     * @throws FormException
     */
    protected function adopt($name,ComponentInterface $component,$position = -1)
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
     * @param int|string $position
     * @return Label
     */
    public function addContent($name,$position = -1)
    {
        return $this->add($name,$position,BaseTypes::CONTENT);
    }

    /**
     * @param $name
     * @param int|string $position
     * @return Label
     */
    public function addLabel($name,$position = -1)
    {
        return $this->add($name,$position,BaseTypes::LABEL);
    }

    /**
     * @param $name
     * @param int|string $position
     * @return Html
     */
    public function addHtml($name,$position = -1)
    {
        return $this->add($name,$position,BaseTypes::HTML);
    }

    /**
     * @param $name
     * @param int|string $position
     * @return HtmlTag
     */
    public function addHtmlTag($name,$position = -1)
    {
        return $this->add($name,$position,BaseTypes::HTMLTAG);
    }

    /**
     * @param $name
     * @param int|string $position
     * @return View
     */
    public function addView($name,$position = -1)
    {
        return $this->add($name,$position,BaseTypes::VIEW);
    }

    /**
     * @param $name
     * @param int|string $position
     * @return Input
     */
    public function addInput($name,$position = -1)
    {
        return $this->add($name,$position,BaseTypes::INPUT);
    }


    /**
     * @param $name
     * @param int|string $position
     * @return Checkbox
     */
    public function addCheckbox($name,$position = -1)
    {
        return $this->add($name,$position,BaseTypes::CHECKBOX);
    }

    /**
     * @param $name
     * @param int|string $position
     * @return Hidden
     */
    public function addHidden($name,$position = -1)
    {
        return $this->add($name,$position,BaseTypes::HIDDEN);
    }

    /**
     * @param $name
     * @param int|string $position
     * @return Select
     */
    public function addSelect($name,$position = -1)
    {
        return $this->add($name,$position,BaseTypes::SELECT);
    }

    /**
     * @param $name
     * @param int|string $position
     * @return Textarea
     */
    public function addTextarea($name,$position = -1)
    {
        return $this->add($name,$position,BaseTypes::TEXTAREA);
    }

    /**
     * @param $name
     * @param int|string $position
     * @return Button
     */
    public function addButton($name,$position = -1)
    {
        return $this->add($name,$position,BaseTypes::BUTTON);
    }

    /**
     * @param $name
     * @param int|string $position
     * @return Container
     */
    public function addContainer($name,$position = -1)
    {
        return $this->add($name,$position,BaseTypes::CONTAINER);
    }

    /**
     * @param $name
     * @param int|string $position
     * @return Aggregator
     */
    public function addAggregator($name,$position = -1)
    {
        return $this->add($name,$position,BaseTypes::AGGREGATOR);
    }

    /**
     * @param $name
     * @param int|string $position
     * @return Fieldset
     */
    public function addFieldset($name,$position = -1)
    {
        return $this->add($name,$position,BaseTypes::FIELDSET);
    }

    /**
     * @param $name
     * @param int|string $position
     * @return Container
     */
    public function addField($name,$position = -1)
    {
        return $this->add($name,$position,BaseTypes::FIELD);
    }

    /**
     * @param $name
     * @param int|string $position
     * @return Row
     */
    public function addRow($name, $position = -1)
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
    protected function useComponent($prototype,$as,$baseType,$baseClass,$position = -1)
    {
        $as = is_null($as) ? $prototype : $as;
        return $this->adopt($as,$this->context->getPrototypes()->export($baseType,$baseClass,$prototype),$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Label
     */
    public function useContent($prototype,$as = null,$position = -1)
    {
        return $this->useComponent($prototype,$as,BaseTypes::CONTENT,Content::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Label
     */
    public function useLabel($prototype,$as = null,$position = -1)
    {
        return $this->useComponent($prototype,$as,BaseTypes::LABEL,Label::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Html
     */
    public function useHtml($prototype,$as = null,$position = -1)
    {
        return $this->useComponent($prototype,$as,BaseTypes::HTML,Html::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return HtmlTag
     */
    public function useHtmlTag($prototype,$as = null,$position = -1)
    {
        return $this->useComponent($prototype,$as,BaseTypes::HTMLTAG,HtmlTag::class,$position);

    }

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return View
     */
    public function useView($prototype,$as = null,$position = -1)
    {
        return $this->useComponent($prototype,$as,BaseTypes::VIEW,View::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Input
     */
    public function useInput($prototype,$as = null,$position = -1)
    {
        return $this->useComponent($prototype,$as,BaseTypes::INPUT,Input::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Checkbox
     */
    public function useCheckbox($prototype,$as = null,$position = -1)
    {
        return $this->useComponent($prototype,$as,BaseTypes::CHECKBOX,Checkbox::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Select
     */
    public function useSelect($prototype,$as = null,$position = -1)
    {
        return $this->useComponent($prototype,$as,BaseTypes::SELECT,Select::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Textarea
     */
    public function useTextarea($prototype,$as = null,$position = -1)
    {
        return $this->useComponent($prototype,$as,BaseTypes::TEXTAREA,Textarea::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Button
     */
    public function useButton($prototype,$as = null,$position = -1)
    {
        return $this->useComponent($prototype,$as,BaseTypes::BUTTON,Button::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Container
     */
    public function useContainer($prototype,$as = null,$position = -1)
    {
        return $this->useComponent($prototype,$as,BaseTypes::CONTAINER,Container::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Aggregator
     */
    public function useAggregator($prototype,$as = null,$position = -1)
    {
        return $this->useComponent($prototype,$as,BaseTypes::AGGREGATOR,Aggregator::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Fieldset
     */
    public function useFieldset($prototype,$as = null,$position = -1)
    {
        return $this->useComponent($prototype,$as,BaseTypes::FIELDSET,Fieldset::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Field
     */
    public function useField($prototype,$as = null,$position = -1)
    {
        return $this->useComponent($prototype,$as,BaseTypes::FIELD,Field::class,$position);
    }

    /**
     * @param $prototype
     * @param null $as
     * @param int|string $position
     * @return Row
     */
    public function useRow($prototype, $as = null, $position = -1)
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
     * @param string|BuilderInterface|RuntimeBuilderInterface|callable $builder
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
     * @param string|BuilderInterface|RuntimeBuilderInterface|callable $builder
     */
    public function setErrorBuilder($builder)
    {
        $this->errorBuilder = $builder;
    }

    /**
     * @param string|BuilderInterface|RuntimeBuilderInterface|callable $builder
     * @return $this
     */
    public function addBuilder($builder)
    {
        $this->builderTypes[] = $builder;
        return $this;
    }

    /**
     * @param string|BuilderInterface|RuntimeBuilderInterface|callable $builder
     * @return $this
     * @throws FormException
     */
    protected function applyBuilderType($builder)
    {
        // callable
        if(is_callable($builder))
        {
            if(is_null($this->state))
            {
                call_user_func($builder,$this);
            }
            else
            {
                call_user_func($builder,$this,$this->state);
            }

            return $this;
        }

        // builder is a type string, create a builder from it using the factory
        if(is_string($builder))
        {
            $builder = $this->getServices()->getBuilders()->get($builder);
        }

        // if it is a simple builder
        if($builder instanceof BuilderInterface)
        {
            $builder->build($this);
        }
        // if it is a runtime builder, also provide the state
        elseif($builder instanceof RuntimeBuilderInterface)
        {
            // check if there actually is a form state
            if(is_null($this->state))
            {
                throw new FormException(sprintf("Cannot apply builder of type RuntimeBuilderInterface: runtime builders can only be applied run-time, not definition-time (%s). Use instance of BuilderInterface instead!",get_class($builder)));
            }

            // apply the runtime builder
            $builder->build($this,$this->state);
        }
        // if anyting else: throw exception
        else
        {
            throw new FormException(sprintf("Incorrect builder argument type (should be one of: string, (Runtime)BuilderInterface, callable, got '%s')",is_object($builder) ? get_class($builder) : gettype($builder)));
        }

        return $this;
    }


    /**
     * @param BuilderInterface $builder
     * @return $this
     * @throws FormException
     */
    public function applyBuilder(BuilderInterface $builder)
    {
        $this->applyBuilderType($builder);
        return $this;
    }



    /**
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
     * @param FormState $state
     * @param array $defaultValues
     * @throws FormException
     */
    public function compile(FormState $state,array $defaultValues = array())
    {
        // set the form context locally
        $this->state = $state;

        // perform hard-coded pre-buildPrototypes actions
        $this->preBuild($state);

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
        $this->compileChildren($this->components,$state,$defaultValues);

        // init the adoption history
        $this->adoptionHistory = array();

        // apply postbuilder (after all nested, recursive children are built, and values are collected, cannot add data components anymore!)
        if(!is_null($this->postBuilder))
        {
            $this->applyBuilderType($this->postBuilder);
        }

        // perform hard-coded post-buildPrototypes actions
        $this->postBuild($state);

        // compile any newly adopted children during post-build
        $this->compileChildren($this->adoptionHistory,$state,$defaultValues);

        // reset the adoption history
        $this->adoptionHistory = array();

        // process any errors found during compilation
        $this->processErrors();

        // compile the errors
        $this->compileChildren($this->adoptionHistory,$state,$defaultValues);
    }

    /**
     * @param array $children
     * @param FormState $state
     * @param array $defaultValues
     */
    protected function compileChildren(array $children,FormState $state,array $defaultValues = array())
    {
        foreach($children as $component)
        {
            if($component instanceof ComponentInterface)
            {
                // compile the child component
                try
                {
                    if($component instanceof DataInterface)
                    {
                        $component->compile($state,$defaultValues);
                    }
                    elseif($component instanceof ContentInterface)
                    {
                        $component->compile($state);
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
                if($component instanceof DataUnitInterface)
                {
                    // if its value should be ignored, return
                    if($component->shouldIgnoreValue())
                    {
                        return;
                    }

                    // store the value
                    $this->storeValue($component);
                }
            }
        }
    }

    /**
     * @param DataUnitInterface $child
     */
    protected function storeValue(DataUnitInterface $child)
    {
        // add the child to the form state
        $this->state->registerComponent($child);
    }

    /**
     * Optionally perform mandatory, container type-specific preBuild operations
     * @param FormState $context
     */
    protected function preBuild(FormState $context) {}

    /**
     * @param FormState $context
     */
    protected function postBuild(FormState $context) {}

    /**
     * @throws FormException
     */
    protected function processErrors()
    {
        // if there are errors and they should be shown
        if($this->showErrors && count($this->errors))
        {
            // apply the error builder
            $this->applyBuilderType($this->errorBuilder);

            // add error css class
            if($this instanceof CssComponentInterface)
            {
                // mark this container to have errors
                $this->addCssClass('errorContainer');
            }
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
        if(!is_null($this->state))
        {
            throw new FormException(sprintf("Cannot clone component during form processing: '%s'",$this->getId()));
        }

        // call parent clone to clone all children
        parent::__clone();

        // unset the current context
        $this->context = null;
    }

    /**
     * @return \Zingular\Forms\Service\ServiceGetterInterface
     */
    protected function getServices()
    {
        return $this->state->getServices();
    }
}