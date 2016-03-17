<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 17-3-2016
 * Time: 20:07
 */

namespace Zingular\Forms\Service;

use Zingular\Forms\Exception\FormException;
use Zingular\Forms\Service\Aggregation\AggregatorPool;
use Zingular\Forms\Service\Bridge\Csrf\CsrfHandlerInterface;
use Zingular\Forms\Service\Bridge\Orm\OrmHandlerInterface;
use Zingular\Forms\Service\Bridge\Persistence\PersistenceHandlerInterface;
use Zingular\Forms\Service\Bridge\Request\RequestHandlerInterface;
use Zingular\Forms\Service\Bridge\Translation\TranslationHandler;
use Zingular\Forms\Service\Bridge\View\ViewHandlerInterface;
use Zingular\Forms\Service\Builder\Container\BuilderPool;
use Zingular\Forms\Service\Builder\Form\FormBuilderFactoryInterface;
use Zingular\Forms\Service\Component\ComponentFactory;
use Zingular\Forms\Service\Condition\ConditionPool;
use Zingular\Forms\Service\Conversion\ConverterPool;
use Zingular\Forms\Service\Evaluation\EvaluationHandler;
use Zingular\Forms\Service\Evaluation\FilterPool;
use Zingular\Forms\Service\Evaluation\ValidatorPool;

/**
 * Class ServiceConsumerTrait
 * @package Zingular\Forms\Service
 */
trait ServiceConsumerTrait
{
    /**
     * @return ServicesInterface
     * @throws FormException
     */
    protected function getServices()
    {
        if(!isset($this->state))
        {
            throw new FormException(sprintf("Cannot retrieve form services: services not set!"));
        }

        return $this->state->getServices();
    }

    /**********************************************************************
     * HANDLER GETTERS
     *********************************************************************/

    /**
     * @return ViewHandlerInterface
     */
    protected function getViewHandler()
    {
        return $this->getServices()->getViewHandler();
    }

    /**
     * @return RequestHandlerInterface
     */
    protected function getRequestHandler()
    {
        return $this->getServices()->getRequestHandler();
    }

    /**
     * @return TranslationHandler
     */
    protected function getTranslator()
    {
        return $this->getServices()->getTranslator();
    }

    /**
     * @return CsrfHandlerInterface
     */
    protected function getCsrfHandler()
    {
        return $this->getServices()->getCsrfHandler();
    }

    /**
     * @return PersistenceHandlerInterface
     */
    protected function getPersistenceHandler()
    {
        return $this->getServices()->getPersistenceHandler();
    }

    /**
     * @return OrmHandlerInterface
     */
    protected function getOrmHandler()
    {
        return $this->getServices()->getOrmHandler();
    }

    /**
     * @return EvaluationHandler
     */
    public function getEvaluationHandler()
    {
        return $this->getServices()->getEvaluationHandler();
    }

    /**
     * @return BuilderPool
     */
    protected function getBuilders()
    {
        return $this->getServices()->getBuilders();
    }

    /**
     * @return AggregatorPool
     */
    protected function getAggregators()
    {
        return $this->getServices()->getAggregators();
    }

    /**
     * @return ConverterPool
     */
    protected function getConverters()
    {
        return $this->getServices()->getConverters();
    }

    /**
     * @return ConditionPool
     */
    protected function getConditions()
    {
        return $this->getServices()->getConditions();
    }

    /**
     * @return ValidatorPool
     */
    protected function getValidators()
    {
        return $this->getServices()->getValidators();
    }

    /**
     * @return FilterPool
     */
    protected function getFilters()
    {
        return $this->getServices()->getFilters();
    }

    /**********************************************************************
     * FACTORY GETTERS
     *********************************************************************/

    /**
     * @return ComponentFactory
     */
    protected function getComponentFactory()
    {
        return $this->getServices()->getComponentFactory();
    }

    /**
     * @return FormBuilderFactoryInterface
     */
    protected function getFormBuilderFactory()
    {
        return $this->getServices()->getFormBuilderFactory();
    }
}