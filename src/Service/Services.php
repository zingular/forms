<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 31-1-2016
 * Time: 21:06
 */

namespace Zingular\Form\Service;
use Zingular\Form\Service\Aggregation\AggregatorFactoryInterface;
use Zingular\Form\Service\Aggregation\AggregatorPool;
use Zingular\Form\Service\Aggregation\PoolableAggregatorInterface;
use Zingular\Form\Service\Builder\BuilderFactoryInterface;
use Zingular\Form\Service\Builder\BuilderPool;
use Zingular\Form\Service\Builder\RegisterableBuilderInterface;
use Zingular\Form\Service\Condition\ConditionFactory;
use Zingular\Form\Service\Condition\ConditionFactoryInterface;
use Zingular\Form\Service\Condition\ConditionInterface;
use Zingular\Form\Service\Evaluation\EvaluationHandler;
use Zingular\Form\Service\Evaluation\FilterFactory;
use Zingular\Form\Service\Evaluation\FilterFactoryInterface;
use Zingular\Form\Service\Evaluation\FilterInterface;
use Zingular\Form\Service\Evaluation\FilterPool;
use Zingular\Form\Service\Evaluation\ValidatorFactory;
use Zingular\Form\Service\Evaluation\ValidatorFactoryInterface;
use Zingular\Form\Service\Evaluation\ValidatorInterface;
use Zingular\Form\Service\Evaluation\ValidatorPool;
use Zingular\Form\Service\Aggregation\AggregatorFactory;
use Zingular\Form\Service\Bridge\Csrf\CsrfHandlerInterface;
use Zingular\Form\Service\Bridge\Csrf\DefaultCsrfHandler;
use Zingular\Form\Service\Bridge\Event\DefaultEventHandler;
use Zingular\Form\Service\Bridge\Event\EventHandlerInterface;
use Zingular\Form\Service\Bridge\Orm\DefaultOrmHandler;
use Zingular\Form\Service\Bridge\Orm\OrmHandlerInterface;
use Zingular\Form\Service\Bridge\Persistence\SessionPersistenceHandler;
use Zingular\Form\Service\Bridge\Persistence\PersistenceHandlerInterface;
use Zingular\Form\Service\Bridge\Request\DefaultRequestHandler;
use Zingular\Form\Service\Bridge\Request\RequestHandlerInterface;
use Zingular\Form\Service\Bridge\Translation\DummyTranslator;
use Zingular\Form\Service\Bridge\Translation\TranslatorInterface;
use Zingular\Form\Service\Builder\BuilderFactory;
use Zingular\Form\Service\Builder\ErrorBuilderFactory;
use Zingular\Form\Service\Component\ComponentFactory;
use Zingular\Form\Service\Bridge\View\DefaultViewHandler;
use Zingular\Form\Service\Bridge\View\ViewHandlerInterface;
use Zingular\Form\Service\Condition\ConditionPool;

/**
 * Class Service
 * @package Zingular\Form
 */
class Services
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
     * @var ErrorBuilderFactory
     */
    protected $errorBuilderFactory;

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
     * @var FilterPool
     */
    protected $filters;

    /**
     * @var ValidatorPool
     */
    protected $validators;

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
    public function addValidator(ValidatorInterface $validator)
    {
        $this->getValidators()->add($validator);
    }

    /**
     * @param FilterInterface $filter
     */
    public function addFilter(FilterInterface $filter)
    {
        $this->getFilters()->add($filter);
    }

    /**
     * @param RegisterableBuilderInterface $builder
     */
    public function addBuilder(RegisterableBuilderInterface $builder)
    {
        $this->getBuilders()->add($builder);
    }

    /**
     * @param PoolableAggregatorInterface $aggregator
     */
    public function addAggregator(PoolableAggregatorInterface $aggregator)
    {
        $this->getAggregators()->add($aggregator);
    }

    /**
     * @param ConditionInterface $condition
     */
    public function addCondition(ConditionInterface $condition)
    {
        $this->getConditions()->add($condition);
    }

    /**********************************************************************
     * SERVICE ADDERS
     *********************************************************************/

    /**
     * @param TranslatorInterface $translator
     */
    public function setTranslator(TranslatorInterface $translator)
    {
        $this->translator = $translator;
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
     * @return TranslatorInterface
     */
    public function getTranslator()
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
            $this->ormHandler = new DefaultOrmHandler();
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
    protected function getValidators()
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
    protected function getFilters()
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
    protected function getConditions()
    {
        if(is_null($this->conditions))
        {
            $this->conditions = new ConditionPool($this->getConditionFactory());
        }

        return $this->conditions;
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
     * @return ErrorBuilderFactory
     */
    public function getErrorBuilderFactory()
    {
        if(is_null($this->errorBuilderFactory))
        {
            $this->errorBuilderFactory = new ErrorBuilderFactory();
        }

        return $this->errorBuilderFactory;
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
}