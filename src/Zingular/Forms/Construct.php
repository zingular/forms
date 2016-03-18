<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 30-1-2016
 * Time: 19:07
 */

namespace Zingular\Forms;

use Zingular\Forms\Component\Containers\FormInterface;
use Zingular\Forms\Component\Containers\Prototypes;

use Zingular\Forms\Exception\FormException;
use Zingular\Forms\Extension\AggregationExtensionInterface;
use Zingular\Forms\Extension\BuilderExtensionInterface;
use Zingular\Forms\Extension\ConditionExtensionInterface;
use Zingular\Forms\Extension\ConverterExtensionInterface;
use Zingular\Forms\Extension\DefaultExtension;
use Zingular\Forms\Extension\ExtensionInterface;
use Zingular\Forms\Extension\FilterExtensionInterface;
use Zingular\Forms\Extension\FormBuilderExtensionInterface;
use Zingular\Forms\Extension\PrototypeExtensionInterface;
use Zingular\Forms\Extension\ValidationExtensionInterface;
use Zingular\Forms\Plugins\Builders\Prototype\BasePrototypeBuilder;
use Zingular\Forms\Plugins\Builders\Form\FormBuilderInterface;
use Zingular\Forms\Plugins\Builders\Prototype\PrototypeBuilderInterface;
use Zingular\Forms\Service\ServiceConsumerTrait;
use Zingular\Forms\Service\ServiceDefinerTrait;
use Zingular\Forms\Service\Services;
use Zingular\Forms\Service\ServicesInterface;

/**
 * Class Construct
 * @package Zingular\Form
 */
class Construct
{
    use ServiceDefinerTrait;
    use ServiceConsumerTrait;


    /**
     * @var Prototypes
     */
    protected $prototypes;

    /**
     * @var PrototypeBuilderInterface
     */
    protected $prototypeBuilder;

    /**
     * @var array
     */
    protected $extensions = array();

    /**
     * @param bool $loadDefaultExtension
     */
    public function __construct($loadDefaultExtension = true)
    {
        // load the default extension
        if($loadDefaultExtension)
        {
            $this->addExtension(new DefaultExtension());
        }
    }

    /**
     * @param ExtensionInterface $extension
     * @throws FormException
     */
    public function addExtension(ExtensionInterface $extension)
    {
        $name = $extension->getExtensionName();

        if(in_array($name,$this->extensions))
        {
            throw new FormException(sprintf("Cannot add extension: there already is an extension registered with the name '%s'",$name),'extension.duplicate');
        }

        // register the extension
        $this->extensions[] = $extension->getExtensionName();

        // add filters
        if($extension instanceof FilterExtensionInterface)
        {
            foreach($extension->getFilterTypes() as $filter)
            {
                $this->addFilterType($filter);
            }
        }

        // add validators
        if($extension instanceof ValidationExtensionInterface)
        {
            foreach($extension->getValidatorTypes() as $validator)
            {
                $this->addValidatorType($validator);
            }
        }

        // add builders
        if($extension instanceof BuilderExtensionInterface)
        {
            foreach($extension->getBuilderTypes() as $builder)
            {
                $this->addBuilderType($builder);
            }
        }

        // add form builders
        if($extension instanceof FormBuilderExtensionInterface)
        {
            foreach($extension->getFormBuilders() as $formBuilder)
            {
                $this->addFormBuilderType($formBuilder);
            }
        }

        // add aggregators
        if($extension instanceof AggregationExtensionInterface)
        {
            foreach($extension->getAggregators() as $aggregator)
            {
                $this->addAggregatorType($aggregator);
            }
        }

        // add conditions
        if($extension instanceof ConditionExtensionInterface)
        {
            foreach($extension->getConditionTypes() as $condition)
            {
                $this->addConditionType($condition);
            }
        }

        // add converters
        if($extension instanceof ConverterExtensionInterface)
        {
            foreach($extension->getConverterTypes() as $converter)
            {
                $this->addConverterType($converter);
            }
        }

        // allow extension to add prototypes
        if($extension instanceof PrototypeExtensionInterface)
        {
            $this->addPrototypes($extension);
        }
    }

    /**
     * @return array
     */
    public function getRegisteredExtensions()
    {
        return $this->extensions;
    }

    /**
     * @param PrototypeBuilderInterface $builder
     */
    public function addPrototypes(PrototypeBuilderInterface $builder)
    {
        $builder->buildPrototypes($this->getPrototypes());
    }

    /**********************************************************************
     * GETTERS
     *********************************************************************/

    /**
     * @return Prototypes
     */
    protected function getPrototypes()
    {
        if(is_null($this->prototypes))
        {
            // create the prototypes container
            $prototypes = $this->getServices()->getComponentFactory()->createPrototypes();

            // make sure the default builder is always applied
            $defaultBuilder = new BasePrototypeBuilder();
            $defaultBuilder->buildPrototypes($prototypes);

            // store the prototypes
            $this->prototypes = $prototypes;
        }

        return $this->prototypes;
    }

    /**********************************************************************
     * CREATORS
     *********************************************************************/

    /**
     * @param $formId
     * @param object $model
     * @return FormInterface
     */
    public function createForm($formId,$model = null)
    {
        // clone the services and prototypes to allow the user to override services per form, with system defaults
        $form = $this->getPrototypes()->exportFormPrototype();

        // create a new form context
        $context = new FormContext(clone $this->getServices(),$formId,clone $this->getPrototypes());

        // set the form context
        $form->setContext($context);

        // also set the model, if provided
        if(!is_null($model))
        {
            $form->setModel($model);
        }

        return $form;
    }

    /**
     * @param FormBuilderInterface|string $builder
     * @param string $formId
     * @param object $model
     * @return FormInterface
     * @throws FormException
     */
    public function buildForm($builder,$formId = null,$model = null)
    {
        // create builder if it is requested using a string
        if(is_string($builder))
        {
            $builder = $this->getServices()->getFormBuilderFactory()->create($builder);
        }
        elseif(!($builder instanceof FormBuilderInterface))
        {
            throw new FormException(sprintf("Cannot build form with id '%': invalid builder type '%s'!",$formId,gettype($builder)));
        }

        // set the form id to form name by default
        $formId = is_null($formId) ? $builder->getFormName() : $formId;

        // actually create the form
        $form = $this->createForm($formId,$model);

        // first, build form-specific prototypes
        $builder->buildPrototypes($form);

        // next, build components
        $builder->buildForm($form);

        // finally, configure the form
        $builder->configureForm($form);

        return $form;
    }

    /**********************************************************************
     * INTERNAL
     *********************************************************************/

    /**
     * @return ServicesInterface
     */
    protected function getServices()
    {
        if(is_null($this->services))
        {
            $this->services = new Services();
        }

        return $this->services;
    }
}