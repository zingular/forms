<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 9-3-2016
 * Time: 20:42
 */

namespace Zingular\Forms\Service;

use Zingular\Forms\Plugins\Aggregators\PoolableAggregatorInterface;
use Zingular\Forms\Plugins\Builders\Container\RegisterableBuilderInterface;
use Zingular\Forms\Plugins\Conditions\ConditionInterface;
use Zingular\Forms\Plugins\Converters\ConverterInterface;
use Zingular\Forms\Plugins\Evaluators\FilterInterface;
use Zingular\Forms\Plugins\Evaluators\ValidatorInterface;
use Zingular\Forms\Service\Bridge\Orm\OrmHandlerInterface;
use Zingular\Forms\Service\Bridge\Translation\TranslatorInterface;
use Zingular\Forms\Service\Bridge\View\ViewHandlerInterface;
use Zingular\Forms\Service\Builder\Form\FormBuilderFactoryInterface;
use Zingular\Forms\Service\Evaluation\FilterFactoryInterface;
use Zingular\Forms\Service\Evaluation\ValidatorFactoryInterface;

/**
 * Interface ServiceSetterInterface
 * @package Zingular\Forms\Component
 */
interface ServiceSetterInterface
{
    /**
     * @param ValidatorInterface $validator
     */
    public function addValidatorType(ValidatorInterface $validator);

    /**
     * @param FilterInterface $filter
     */
    public function addFilterType(FilterInterface $filter);

    /**
     * @param RegisterableBuilderInterface $builder
     */
    public function addBuilderType(RegisterableBuilderInterface $builder);

    /**
     * @param PoolableAggregatorInterface $aggregator
     */
    public function addAggregatorType(PoolableAggregatorInterface $aggregator);

    /**
     * @param ConditionInterface $condition
     */
    public function addConditionType(ConditionInterface $condition);

    /**
     * @param ConverterInterface $converter
     */
    public function addConverterType(ConverterInterface $converter);

    /**
     * @param TranslatorInterface $translator
     */
    public function setTranslator(TranslatorInterface $translator);

    /**
     * @param FilterFactoryInterface $factory
     */
    public function setFilterFactory(FilterFactoryInterface $factory);

    /**
     * @param ValidatorFactoryInterface $factory
     */
    public function setValidatorFactory(ValidatorFactoryInterface $factory);

    /**
     * @param FormBuilderFactoryInterface $factory
     */
    public function setFormBuilderFactory(FormBuilderFactoryInterface $factory);

    /**
     * @param OrmHandlerInterface $handler
     */
    public function setOrmHandler(OrmHandlerInterface $handler);

    /**
     * @param ViewHandlerInterface $handler
     */
    public function setViewHandler(ViewHandlerInterface $handler);
}