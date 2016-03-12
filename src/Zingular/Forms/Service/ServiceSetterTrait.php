<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 16-2-2016
 * Time: 18:33
 */

namespace Zingular\Forms\Service;

use Zingular\Forms\Service\ServiceSetterInterface;
use Zingular\Forms\Plugins\Aggregators\PoolableAggregatorInterface;
use Zingular\Forms\Service\Bridge\Orm\OrmHandlerInterface;
use Zingular\Forms\Service\Bridge\View\ViewHandlerInterface;
use Zingular\Forms\Plugins\Builders\Container\RegisterableBuilderInterface;
use Zingular\Forms\Plugins\Conditions\ConditionInterface;
use Zingular\Forms\Plugins\Converters\ConverterInterface;
use Zingular\Forms\Service\Builder\Form\FormBuilderFactoryInterface;
use Zingular\Forms\Service\Evaluation\FilterFactoryInterface;
use Zingular\Forms\Plugins\Evaluators\FilterInterface;
use Zingular\Forms\Service\Evaluation\ValidatorFactoryInterface;
use Zingular\Forms\Plugins\Evaluators\ValidatorInterface;
use Zingular\Forms\Service\Bridge\Translation\TranslatorInterface;

/**
 * Class ServiceSetterTrait
 * @package Zingular\Form\Component
 */
trait ServiceSetterTrait
{
    /**
     * @var ServiceSetterInterface
     */
    protected $services;

    /**
     * @return ServiceSetterInterface
     */
    protected function getServices()
    {
        return $this->services;
    }

    /**
     * @param ValidatorInterface $validator
     */
    public function addValidatorType(ValidatorInterface $validator)
    {
        $this->getServices()->addValidatorType($validator);
    }

    /**
     * @param FilterInterface $filter
     */
    public function addFilterType(FilterInterface $filter)
    {
        $this->getServices()->addFilterType($filter);
    }

    /**
     * @param RegisterableBuilderInterface $builder
     */
    public function addBuilderType(RegisterableBuilderInterface $builder)
    {
        $this->getServices()->addBuilderType($builder);
    }

    /**
     * @param PoolableAggregatorInterface $aggregator
     */
    public function addAggregatorType(PoolableAggregatorInterface $aggregator)
    {
        $this->getServices()->addAggregatorType($aggregator);
    }

    /**
     * @param ConditionInterface $condition
     */
    public function addConditionType(ConditionInterface $condition)
    {
        $this->getServices()->addConditionType($condition);
    }

    /**
     * @param ConverterInterface $converter
     */
    public function addConverterType(ConverterInterface $converter)
    {
        $this->getServices()->addConverterType($converter);
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
     * @param FormBuilderFactoryInterface $factory
     */
    public function setFormBuilderFactory(FormBuilderFactoryInterface $factory)
    {
        $this->getServices()->setFormBuilderFactory($factory);
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