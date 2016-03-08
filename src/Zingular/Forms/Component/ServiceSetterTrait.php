<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 16-2-2016
 * Time: 18:33
 */

namespace Zingular\Forms\Component;

use Zingular\Forms\Plugins\Aggregators\PoolableAggregatorInterface;
use Zingular\Forms\Service\Bridge\Orm\OrmHandlerInterface;
use Zingular\Forms\Service\Bridge\View\ViewHandlerInterface;
use Zingular\Forms\Plugins\Builders\Container\RegisterableBuilderInterface;
use Zingular\Forms\Plugins\Conditions\ConditionInterface;
use Zingular\Forms\Plugins\Converters\ConverterInterface;
use Zingular\Forms\Service\Evaluation\FilterFactoryInterface;
use Zingular\Forms\Plugins\Evaluators\FilterInterface;
use Zingular\Forms\Service\Evaluation\ValidatorFactoryInterface;
use Zingular\Forms\Plugins\Evaluators\ValidatorInterface;
use Zingular\Forms\Service\Bridge\Translation\TranslatorInterface;
use Zingular\Forms\Service\Services;

/**
 * Class ServiceSetterTrait
 * @package Zingular\Form\Component
 */
trait ServiceSetterTrait
{
    /**
     * @var Services
     */
    protected $services;

    /**
     * @return Services
     */
    protected function getServices()
    {
        return $this->services;
    }

    /**
     * @param \Zingular\Forms\Plugins\Evaluators\ValidatorInterface $validator
     */
    public function addValidatorType(ValidatorInterface $validator)
    {
        $this->getServices()->addValidator($validator);
    }

    /**
     * @param FilterInterface $filter
     */
    public function addFilterType(FilterInterface $filter)
    {
        $this->getServices()->addFilter($filter);
    }

    /**
     * @param \Zingular\Forms\Plugins\Builders\Container\RegisterableBuilderInterface $builder
     */
    public function addBuilderType(RegisterableBuilderInterface $builder)
    {
        $this->getServices()->addBuilder($builder);
    }

    /**
     * @param PoolableAggregatorInterface $aggregator
     */
    public function addAggregatorStrategy(PoolableAggregatorInterface $aggregator)
    {
        $this->getServices()->addAggregator($aggregator);
    }

    /**
     * @param ConditionInterface $condition
     */
    public function addConditionType(ConditionInterface $condition)
    {
        $this->getServices()->addCondition($condition);
    }

    /**
     * @param \Zingular\Forms\Plugins\Converters\ConverterInterface $converter
     */
    public function addConverter(ConverterInterface $converter)
    {
        $this->getServices()->addConverter($converter);
    }


    /**
     * @param TranslatorInterface $translator
     */
    public function setTranslator(TranslatorInterface $translator)
    {
        $this->getServices()->setTranslator($translator);
    }

    /**
     * @param FilterFactoryInterface $factory
     */
    public function setFilterFactory(FilterFactoryInterface $factory)
    {
        $this->getServices()->setFilterFactory($factory);
    }

    /**
     * @param ValidatorFactoryInterface $factory
     */
    public function setValidatorFactory(ValidatorFactoryInterface $factory)
    {
        $this->getServices()->setValidatorFactory($factory);
    }

    /**
     * @param OrmHandlerInterface $handler
     */
    public function setOrmHandler(OrmHandlerInterface $handler)
    {
        $this->getServices()->setOrmHandler($handler);
    }

    /**
     * @param ViewHandlerInterface $handler
     */
    public function setViewHandler(ViewHandlerInterface $handler)
    {
        $this->getServices()->setViewHandler($handler);
    }
}