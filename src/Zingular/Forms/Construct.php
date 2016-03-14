<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 30-1-2016
 * Time: 19:07
 */

namespace Zingular\Forms;
use Zingular\Forms\Component\Containers\Form;
use Zingular\Forms\Component\Containers\Prototypes;
use Zingular\Forms\Exception\FormException;
use Zingular\Forms\Extension\DefaultExtension;
use Zingular\Forms\Extension\ExtensionInterface;
use Zingular\Forms\Plugins\Builders\Prototype\DefaultPrototypeBuilder;
use Zingular\Forms\Plugins\Builders\Form\FormBuilderInterface;
use Zingular\Forms\Service\Builder\Prototypes\PrototypeBuilderInterface;
use Zingular\Forms\Service\Services;
use Zingular\Forms\Service\ServicesInterface;

/**
 * Class Construct
 * @package Zingular\Form
 */
class Construct
{
    use Service\ServiceSetterTrait;

    /**
     * @var Prototypes
     */
    protected $prototypes;

    /**
     * @var PrototypeBuilderInterface
     */
    protected $prototypeBuilder;

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
     */
    public function addExtension(ExtensionInterface $extension)
    {
        // add filters
        foreach($extension->getFilters() as $filter)
        {
            $this->addFilterType($filter);
        }

        // add validators
        foreach($extension->getValidators() as $validator)
        {
            $this->addValidatorType($validator);
        }

        // add builders
        foreach($extension->getBuilders() as $builder)
        {
            $this->addBuilderType($builder);
        }

        // add aggregators
        foreach($extension->getAggregators() as $aggregator)
        {
            $this->addAggregatorType($aggregator);
        }

        // add conditions
        foreach($extension->getConditions() as $condition)
        {
            $this->addConditionType($condition);
        }

        // add converters
        foreach($extension->getConverters() as $converter)
        {
            $this->addConverterType($converter);
        }

        // allow extension to add prototypes
        $this->addPrototypes($extension);
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
            $defaultBuilder = new DefaultPrototypeBuilder();
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
     * @return Form
     */
    public function createForm($formId,$model = null)
    {
        // clone the services and prototypes to allow the user to override services per form, with system defaults
        $form = $this
            ->getServices()
            ->getComponentFactory()
            ->createForm($formId,clone $this->getServices(),clone $this->getPrototypes());

        // also set the model, if provided
        if(!is_null($model))
        {
            $form->setModel($model);
        }

        return $form;
    }

    /**
     * @param string $formId
     * @param FormBuilderInterface|string $builder
     * @param object $model
     * @return Form
     * @throws FormException
     */
    public function buildForm($formId,$builder,$model = null)
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