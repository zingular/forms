<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 16-2-2016
 * Time: 18:33
 */

namespace Zingular\Forms\Component;

use Zingular\Forms\Service\Aggregation\PoolableAggregatorInterface;
use Zingular\Forms\Service\Builder\RegisterableBuilderInterface;
use Zingular\Forms\Service\Condition\ConditionInterface;
use Zingular\Forms\Service\Evaluation\FilterFactoryInterface;
use Zingular\Forms\Service\Evaluation\FilterInterface;
use Zingular\Forms\Service\Evaluation\ValidatorFactoryInterface;
use Zingular\Forms\Service\Evaluation\ValidatorInterface;
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
     * @param ValidatorInterface $validator
     */
    public function addValidator(ValidatorInterface $validator)
    {
        $this->getServices()->addValidator($validator);
    }

    /**
     * @param FilterInterface $filter
     */
    public function addFilter(FilterInterface $filter)
    {
        $this->getServices()->addFilter($filter);
    }

    /**
     * @param RegisterableBuilderInterface $builder
     */
    public function addBuilder(RegisterableBuilderInterface $builder)
    {
        $this->getServices()->addBuilder($builder);
    }

    /**
     * @param PoolableAggregatorInterface $aggregator
     */
    public function addAggregator(PoolableAggregatorInterface $aggregator)
    {
        $this->getServices()->addAggregator($aggregator);
    }

    /**
     * @param ConditionInterface $condition
     */
    public function addCondition(ConditionInterface $condition)
    {
        $this->getServices()->addCondition($condition);
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
}