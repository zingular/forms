<?php

namespace Zingular\Forms\Component\Containers;

use Zingular\Forms\Builder;
use Zingular\Forms\Component\CompilableComponentInterface;
use Zingular\Forms\Component\ComponentInterface;
use Zingular\Forms\Component\ComponentTrait;
use Zingular\Forms\Component\ConditionableInterface;
use Zingular\Forms\Component\Context;
use Zingular\Forms\Component\CssComponentTrait;
use Zingular\Forms\Component\DataComponentInterface;
use Zingular\Forms\Component\DataUnitComponentInterface;
use Zingular\Forms\Component\Elements\Controls\AbstractControl;
use Zingular\Forms\Component\FormState;
use Zingular\Forms\Component\CssComponentInterface;
use Zingular\Forms\Component\HtmlAttributesTrait;
use Zingular\Forms\Plugins\Conditions\ConditionGroup;
use Zingular\Forms\Service\ServiceGetterInterface;
use Zingular\Forms\Component\ViewableComponentInterface;
use Zingular\Forms\Component\ViewSetterTrait;
use Zingular\Forms\Exception\FormException;
use Zingular\Forms\Plugins\Builders\Container\RuntimeBuilderInterface;
use Zingular\Forms\Plugins\Builders\Options\OptionsBuilder;
use Zingular\Forms\Plugins\Builders\Container\BuilderInterface;
use Zingular\Forms\Validator;


/**
 * Class Container
 * @package Zingular\Form
 */
class Container extends AbstractContainer implements
    DataComponentInterface,
    BuildableInterface,
    CssComponentInterface,
    ViewableComponentInterface,
    ConditionableInterface
{
    use ComponentTrait;
    use ViewSetterTrait;
    use CssComponentTrait;
    use HtmlAttributesTrait;
    use BuildableTrait;
    //use ConditionableTrait;

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
     * @var array
     */
    protected $conditions = array();

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

    /**
     * @return Context
     */
    protected function getContext()
    {
        return $this->context;
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
                    // TODO: move to containing class? now, form cannot have conditions itself (or manually re-implement that in its compile method?)
                    if($component instanceof ConditionableInterface)
                    {
                        $component->applyConditions($state);
                    }

                    // if it is a data component, compile with default values
                    if($component instanceof DataComponentInterface)
                    {
                        $component->compile($state,$defaultValues);
                    }
                    // if it is a regular compilable component, compile with state only
                    elseif($component instanceof CompilableComponentInterface)
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
                if($component instanceof DataUnitComponentInterface)
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
     * @param DataUnitComponentInterface $child
     */
    protected function storeValue(DataUnitComponentInterface $child)
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
        $this->errors = null;

        // unset the current context
        $this->context = null;
    }

    /**
     * @return ServiceGetterInterface
     */
    protected function getServices()
    {
        return $this->state->getServices();
    }

    /***************************************************************
     * CONDITIONABLE
     **************************************************************/

    /**
     * @param $condition
     * @param ...$params
     * @return static
     */
    public function addCondition($condition, ...$params)
    {
        // create a new condition container
        $container = $this->addContainer('__condition__'.count($this->conditions))
            ->setViewName(\Zingular\Forms\View::TRANSPARENT);

        // create a new condition group
        $group = new ConditionGroup($container,$condition,$params,$this);

        // add the condition group to the conditions list
        $this->conditions[] = $group;

        // return the condition group
        return $group;
    }

    /**
     * @param string $field
     * @param string $validator
     * @param ...$params
     * @return static
     */
    public function addConditionOn($field, $validator = Validator::HAS_VALUE, ...$params)
    {

    }



    /**
     * @return static
     */
    public function endCondition()
    {
        // DUMMY METHOD TO FOOL EDI, NEVER ACTUALLY CALLED
        return $this;
    }

    /**
     * @param FormState $state
     */
    public function applyConditions(FormState $state)
    {
        /** @var ConditionGroup $condition */
        foreach($this->conditions as $condition)
        {
            // TODO: see if it is condition ON and if so, add set it as selector via state

            $condition->execute($state);
        }
    }
}