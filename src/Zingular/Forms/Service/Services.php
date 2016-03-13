<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 31-1-2016
 * Time: 21:06
 */

namespace Zingular\Forms\Service;
use Zingular\Forms\Service\Aggregation\AggregatorFactoryInterface;
use Zingular\Forms\Service\Aggregation\AggregatorPool;
use Zingular\Forms\Plugins\Aggregators\PoolableAggregatorInterface;
use Zingular\Forms\Service\Bridge\Translation\TranslationHandler;
use Zingular\Forms\Service\Builder\Container\BuilderFactoryInterface;
use Zingular\Forms\Service\Builder\Container\BuilderPool;
use Zingular\Forms\Plugins\Builders\Container\RegisterableRuntimeBuilderInterface;
use Zingular\Forms\Service\Builder\Form\FormBuilderFactory;
use Zingular\Forms\Service\Builder\Form\FormBuilderFactoryInterface;
use Zingular\Forms\Service\Condition\ConditionFactory;
use Zingular\Forms\Service\Condition\ConditionFactoryInterface;
use Zingular\Forms\Plugins\Conditions\ConditionInterface;
use Zingular\Forms\Service\Conversion\ConverterFactory;
use Zingular\Forms\Service\Conversion\ConverterFactoryInterface;
use Zingular\Forms\Plugins\Converters\ConverterInterface;
use Zingular\Forms\Service\Conversion\ConverterPool;
use Zingular\Forms\Service\Evaluation\EvaluationHandler;
use Zingular\Forms\Service\Evaluation\FilterFactory;
use Zingular\Forms\Service\Evaluation\FilterFactoryInterface;
use Zingular\Forms\Plugins\Evaluators\FilterInterface;
use Zingular\Forms\Service\Evaluation\FilterPool;
use Zingular\Forms\Service\Evaluation\ValidatorFactory;
use Zingular\Forms\Service\Evaluation\ValidatorFactoryInterface;
use Zingular\Forms\Plugins\Evaluators\ValidatorInterface;
use Zingular\Forms\Service\Evaluation\ValidatorPool;
use Zingular\Forms\Service\Aggregation\AggregatorFactory;
use Zingular\Forms\Service\Bridge\Csrf\CsrfHandlerInterface;
use Zingular\Forms\Service\Bridge\Csrf\DefaultCsrfHandler;
use Zingular\Forms\Service\Bridge\Event\DefaultEventHandler;
use Zingular\Forms\Service\Bridge\Event\EventHandlerInterface;
use Zingular\Forms\Service\Bridge\Orm\PublicPropertyOrmHandler;
use Zingular\Forms\Service\Bridge\Orm\OrmHandlerInterface;
use Zingular\Forms\Service\Bridge\Persistence\SessionPersistenceHandler;
use Zingular\Forms\Service\Bridge\Persistence\PersistenceHandlerInterface;
use Zingular\Forms\Service\Bridge\Request\DefaultRequestHandler;
use Zingular\Forms\Service\Bridge\Request\RequestHandlerInterface;
use Zingular\Forms\Service\Bridge\Translation\DummyTranslator;
use Zingular\Forms\Service\Bridge\Translation\TranslatorInterface;
use Zingular\Forms\Service\Builder\Container\BuilderFactory;
use Zingular\Forms\Service\Component\ComponentFactory;
use Zingular\Forms\Service\Bridge\View\DefaultViewHandler;
use Zingular\Forms\Service\Bridge\View\ViewHandlerInterface;
use Zingular\Forms\Service\Condition\ConditionPool;

/**
 * Class Service
 * @package Zingular\Form\Service
 */
class Services implements ServicesInterface
{
    /**
     * @var ComponentFactory
     */
    protected $componentFactory;

    /**
     * @var ViewHandlerInterface
     */
    protected $viewHandler;

    /**
     * @var AggregatorFactory
     */
    protected $aggregatorFactory;

    /**
     * @var BuilderFactoryInterface
     */
    protected $builderFactory;

    /**
     * @var FormBuilderFactoryInterface
     */
    protected $formBuilderFactory;

    /**
     * @var ConditionPool
     */
    protected $conditions;

    /**
     * @var RequestHandlerInterface
     */
    protected $requestHandler;

    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * @var TranslatorInterface
     */
    protected $translationHandler;

    /**
     * @var CsrfHandlerInterface
     */
    protected $csrfHandler;

    /**
     * @var EventHandlerInterface
     */
    protected $eventHandler;

    /**
     * @var PersistenceHandlerInterface
     */
    protected $persistenceHandler;

    /**
     * @var OrmHandlerInterface
     */
    protected $ormHandler;

    /**
     * @var FilterFactoryInterface
     */
    protected $filterFactory;

    /**
     * @var ValidatorFactoryInterface
     */
    protected $validatorFactory;

    /**
     * @var ConditionFactoryInterface
     */
    protected $conditionFactory;

    /**
     * @var ConverterFactoryInterface
     */
    protected $converterFactory;

    /**
     * @var FilterPool
     */
    protected $filters;

    /**
     * @var ValidatorPool
     */
    protected $validators;

    /**
     * @var ConverterPool
     */
    protected $converters;

    /**
     * @var BuilderPool
     */
    protected $builders;

    /**
     * @var AggregatorPool
     */
    protected $aggregators;

    /**
     * @var EvaluationHandler
     */
    protected $evaluationHandler;

    /**********************************************************************
     * COMPONENT ADDERS
     *********************************************************************/

    /**
     * @param ValidatorInterface $validator
     */
    public function addValidatorType(ValidatorInterface $validator)
    {
        $this->getValidators()->add($validator);
    }

    /**
     * @param FilterInterface $filter
     */
    public function addFilterType(FilterInterface $filter)
    {
        $this->getFilters()->add($filter);
    }

    /**
     * @param RegisterableRuntimeBuilderInterface $builder
     */
    public function addBuilderType(RegisterableRuntimeBuilderInterface $builder)
    {
        $this->getBuilders()->add($builder);
    }

    /**
     * @param PoolableAggregatorInterface $aggregator
     */
    public function addAggregatorType(PoolableAggregatorInterface $aggregator)
    {
        $this->getAggregators()->add($aggregator);
    }

    /**
     * @param ConditionInterface $condition
     */
    public function addConditionType(ConditionInterface $condition)
    {
        $this->getConditions()->add($condition);
    }

    /**
     * @param ConverterInterface $converter
     */
    public function addConverterType(ConverterInterface $converter)
    {
        $this->getConverters()->add($converter);
    }

    /**********************************************************************
     * SERVICE SETTERS
     *********************************************************************/

    /**
     * @param TranslatorInterface $translator
     */
    public function setTranslator(TranslatorInterface $translator)
    {
        $this->getTranslator()->setTranslator($translator);
    }

    /**
     * @param OrmHandlerInterface $handler
     */
    public function setOrmHandler(OrmHandlerInterface $handler)
    {
        $this->ormHandler = $handler;
    }

    /**
     * @param ViewHandlerInterface $handler
     */
    public function setViewHandler(ViewHandlerInterface $handler)
    {
        $this->viewHandler = $handler;
    }

    /**********************************************************************
     * FACTORY SETTERS
     *********************************************************************/

    /**
     * @param FilterFactoryInterface $factory
     */
    public function setFilterFactory(FilterFactoryInterface $factory)
    {
        $this->filterFactory = $factory;
    }

    /**
     * @param ValidatorFactoryInterface $factory
     */
    public function setValidatorFactory(ValidatorFactoryInterface $factory)
    {
        $this->validatorFactory = $factory;
    }

    /**
     * @param BuilderFactoryInterface $factory
     */
    public function setBuilderFactory(BuilderFactoryInterface $factory)
    {
        $this->builderFactory = $factory;
    }

    /**
     * @param AggregatorFactoryInterface $factory
     */
    public function setAggregatorFactory(AggregatorFactoryInterface $factory)
    {
        $this->aggregatorFactory = $factory;
    }

    /**
     * @param ConverterFactoryInterface $factory
     */
    public function setConverterFactory(ConverterFactoryInterface $factory)
    {
        $this->converterFactory = $factory;
    }


    /**
     * @param FormBuilderFactoryInterface $factory
     */
    public function setFormBuilderFactory(FormBuilderFactoryInterface $factory)
    {
        $this->formBuilderFactory = $factory;
    }

    /**********************************************************************
     * HANDLER GETTERS
     *********************************************************************/

    /**
     * @return ViewHandlerInterface
     */
    public function getViewHandler()
    {
        if(is_null($this->viewHandler))
        {
            $this->viewHandler = new DefaultViewHandler();
        }

        return $this->viewHandler;
    }

    /**
     * @return RequestHandlerInterface
     */
    public function getRequestHandler()
    {
        if(is_null($this->requestHandler))
        {
            $this->requestHandler = new DefaultRequestHandler();
        }

        return $this->requestHandler;
    }

    /**
     * @return TranslationHandler
     */
    public function getTranslator()
    {
        if(is_null($this->translationHandler))
        {
            $this->translationHandler = new TranslationHandler();
            $this->translationHandler->setTranslator($this->getDefaultTranslator());
        }

        return $this->translationHandler;
    }

    /**
     * @return TranslatorInterface
     */
    protected function getDefaultTranslator()
    {
        if(is_null($this->translator))
        {
            $this->translator = new DummyTranslator();
        }

        return $this->translator;
    }

    /**
     * @return CsrfHandlerInterface
     */
    public function getCsrfHandler()
    {
        if(is_null($this->csrfHandler))
        {
            $this->csrfHandler = new DefaultCsrfHandler();
        }

        return $this->csrfHandler;
    }

    /**
     * @return EventHandlerInterface
     */
    public function getEventHandler()
    {
        if(is_null($this->eventHandler))
        {
            $this->eventHandler = new DefaultEventHandler();
        }

        return $this->eventHandler;
    }

    /**
     * @return PersistenceHandlerInterface
     */
    public function getPersistenceHandler()
    {
        if(is_null($this->persistenceHandler))
        {
            $this->persistenceHandler = new SessionPersistenceHandler();
        }

        return $this->persistenceHandler;
    }

    /**
     * @return OrmHandlerInterface
     */
    public function getOrmHandler()
    {
        if(is_null($this->ormHandler))
        {
            $this->ormHandler = new PublicPropertyOrmHandler();
        }

        return $this->ormHandler;
    }

    /**
     * @return EvaluationHandler
     */
    public function getEvaluationHandler()
    {
        if(is_null($this->evaluationHandler))
        {
            $this->evaluationHandler = new EvaluationHandler($this->getFilters(),$this->getValidators());
        }

        return $this->evaluationHandler;
    }

    /**********************************************************************
     * POOL GETTERS
     *********************************************************************/

    /**
     * @return ValidatorPool
     */
    public function getValidators()
    {
        if(is_null($this->validators))
        {
            $this->validators = new ValidatorPool($this->getValidatorFactory());
        }

        return $this->validators;
    }

    /**
     * @return FilterPool
     */
    public function getFilters()
    {
        if(is_null($this->filters))
        {
            $this->filters = new FilterPool($this->getFilterFactory());
        }

        return $this->filters;
    }

    /**
     * @return BuilderPool
     */
    public function getBuilders()
    {
        if(is_null($this->builders))
        {
            $this->builders = new BuilderPool($this->getBuilderFactory());
        }

        return $this->builders;
    }

    /**
     * @return AggregatorPool
     */
    public function getAggregators()
    {
        if(is_null($this->aggregators))
        {
            $this->aggregators = new AggregatorPool($this->getAggregatorFactory());
        }

        return $this->aggregators;
    }

    /**
     * @return ConditionPool
     */
    public function getConditions()
    {
        if(is_null($this->conditions))
        {
            $this->conditions = new ConditionPool($this->getConditionFactory());
        }

        return $this->conditions;
    }

    /**
     * @return ConverterPool
     */
    public function getConverters()
    {
        if(is_null($this->converters))
        {
            $this->converters = new ConverterPool($this->getConverterFactory());
        }

        return $this->converters;
    }

    /**********************************************************************
     * FACTORY GETTERS
     *********************************************************************/

    /**
     * @return ComponentFactory
     */
    public function getComponentFactory()
    {
        if(is_null($this->componentFactory))
        {
            $this->componentFactory = new ComponentFactory();
        }

        return $this->componentFactory;
    }

    /**
     * @return FilterFactory
     */
    protected function getFilterFactory()
    {
        if(is_null($this->filterFactory))
        {
            $this->filterFactory = new FilterFactory();
        }

        return $this->filterFactory;
    }

    /**
     * @return ValidatorFactory
     */
    protected function getValidatorFactory()
    {
        if(is_null($this->validatorFactory))
        {
            $this->validatorFactory = new ValidatorFactory();
        }

        return $this->validatorFactory;
    }


    /**
     * @return AggregatorFactory
     */
    protected function getAggregatorFactory()
    {
        if(is_null($this->aggregatorFactory))
        {
            $this->aggregatorFactory = new AggregatorFactory();
        }

        return $this->aggregatorFactory;
    }

    /**
     * @return BuilderFactoryInterface
     */
    protected function getBuilderFactory()
    {
        if(is_null($this->builderFactory))
        {
            $this->builderFactory = new BuilderFactory();
        }

        return $this->builderFactory;
    }

    /**
     * @return FormBuilderFactoryInterface
     */
    public function getFormBuilderFactory()
    {
        if(is_null($this->formBuilderFactory))
        {
            $this->formBuilderFactory = new FormBuilderFactory();
        }

        return $this->formBuilderFactory;
    }

    /**
     * @return ConditionFactoryInterface
     */
    protected function getConditionFactory()
    {
        if(is_null($this->conditionFactory))
        {
            $this->conditionFactory = new ConditionFactory();
        }

        return $this->conditionFactory;
    }

    /**
     * @return ConverterFactoryInterface
     */
    protected function getConverterFactory()
    {
        if(is_null($this->converterFactory))
        {
            $this->converterFactory = new ConverterFactory();
        }

        return $this->converterFactory;
    }

    /**********************************************************************
     * INTERNAL
     *********************************************************************/

    /**
     *
     */
    public function __clone()
    {
        // make sure to clone the translation handler, so forms have their own instance that can use a different translator
        if(!is_null($this->translationHandler))
        {
            $this->translationHandler = clone $this->translationHandler;
        }
    }

}