<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 30-1-2016
 * Time: 19:07
 */

namespace Zingular\Form;
use Zingular\Form\Component\Container\Form;
use Zingular\Form\Component\Container\Prototypes;
use Zingular\Form\Component\ServiceSetterTrait;
use Zingular\Form\Extension\DefaultExtension;
use Zingular\Form\Extension\ExtensionInterface;
use Zingular\Form\Service\Bridge\Translation\TranslatorInterface;
use Zingular\Form\Service\Builder\DefaultPrototypeBuilder;
use Zingular\Form\Service\Builder\FormbuilderInterface;
use Zingular\Form\Service\Builder\PrototypeBuilderInterface;
use Zingular\Form\Service\Services;

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
            $this->addFilter($filter);
        }

        // add validators
        foreach($extension->getValidators() as $validator)
        {
            $this->addValidator($validator);
        }

        // add builders
        foreach($extension->getBuilders() as $builder)
        {
            $this->addBuilder($builder);
        }

        // add aggregators
        foreach($extension->getAggregators() as $aggregator)
        {
            $this->addAggregator($aggregator);
        }

        // add conditions
        foreach($extension->getConditions() as $condition)
        {
            $this->addCondition($condition);
        }
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