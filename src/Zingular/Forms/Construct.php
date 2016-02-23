<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 30-1-2016
 * Time: 19:07
 */

namespace Zingular\Forms;
use Zingular\Forms\Component\Container\Form;
use Zingular\Forms\Component\Container\Prototypes;
use Zingular\Forms\Component\ServiceSetterTrait;
use Zingular\Forms\Extension\DefaultExtension;
use Zingular\Forms\Extension\ExtensionInterface;
use Zingular\Forms\Service\Bridge\Translation\TranslatorInterface;
use Zingular\Forms\Service\Builder\DefaultPrototypeBuilder;
use Zingular\Forms\Service\Builder\FormbuilderInterface;
use Zingular\Forms\Service\Builder\PrototypeBuilderInterface;
use Zingular\Forms\Service\Services;

/**
 * Class Construct
 * @package Zingular\Form
 */
class Construct
{
    use ServiceSetterTrait;

    /**
     * @var Prototypes
     */
    protected $prototypes;

    /**
     * @var PrototypeBuilderInterface
     */
    protected $prototypeBuilder;

    /**
     * @param PrototypeBuilderInterface $masterRepositoryBuilder
     * @param bool $loadDefaultExtension
     */
    public function __construct(PrototypeBuilderInterface $masterRepositoryBuilder = null,$loadDefaultExtension = true)
    {
        if(!is_null($masterRepositoryBuilder))
        {
            $this->setPrototypeBuilder($masterRepositoryBuilder);
        }

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
            $this->addAggregatorStrategy($aggregator);
        }

        // add conditions
        foreach($extension->getConditions() as $condition)
        {
            $this->addConditionType($condition);
        }

        // allow extension to add prototypes
        $extension->buildPrototypes($this->getPrototypes());
    }

    /**********************************************************************
     * SERVICE SETTERS
     *********************************************************************/

    /**
     * @param PrototypeBuilderInterface $builder
     */
    protected function setPrototypeBuilder(PrototypeBuilderInterface $builder)
    {
        $this->prototypeBuilder = $builder;
    }

    /**
     * @param TranslatorInterface $translator
     */
    public function setTranslator(TranslatorInterface $translator)
    {
        $this->getServices()->setTranslator($translator);
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
            $this->prototypes = new Prototypes($this->getServices()->getComponentFactory());

            $defaultBuilder = new DefaultPrototypeBuilder();
            $defaultBuilder->buildPrototypes($this->prototypes);

            // todo: allow multiple prototype builders?
            $this->getPrototypeBuilder()->buildPrototypes($this->prototypes);
        }

        return $this->prototypes;
    }

    /**
     * @return PrototypeBuilderInterface
     */
    protected function getPrototypeBuilder()
    {
        if(is_null($this->prototypeBuilder))
        {
            $this->prototypeBuilder = new DefaultPrototypeBuilder();
        }

        return $this->prototypeBuilder;
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
        // clone the services to allow the user to override services per form, with system defaults

        // TODO: clone prototypes to allow the user to override prototypes per form, with system defaults

        $form = new Form($formId,clone $this->getServices(),clone $this->getPrototypes(),$model);

        return $form;
    }

    /**
     * @param string $formId
     * @param FormbuilderInterface $builder
     * @param null $model
     * @return Form
     */
    public function buildForm($formId,FormbuilderInterface $builder,$model = null)
    {
        $form = $this->createForm($formId,$model);

        $builder->build($form);
        $builder->configureForm($form);

        return $form;
    }

    /**********************************************************************
     * INTERNAL
     *********************************************************************/

    /**
     * @return Services
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