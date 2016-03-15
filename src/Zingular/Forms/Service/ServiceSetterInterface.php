<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 9-3-2016
 * Time: 20:42
 */

namespace Zingular\Forms\Service;

use Zingular\Forms\Plugins\Aggregators\AggregatorTypeInterface;
use Zingular\Forms\Plugins\Builders\Container\BuilderTypeInterface;
use Zingular\Forms\Plugins\Builders\Form\FormBuilderInterface;
use Zingular\Forms\Plugins\Conditions\ConditionInterface;
use Zingular\Forms\Plugins\Conditions\ConditionTypeInterface;
use Zingular\Forms\Plugins\Converters\ConverterInterface;
use Zingular\Forms\Plugins\Converters\ConverterTypeInterface;
use Zingular\Forms\Plugins\Evaluators\FilterInterface;
use Zingular\Forms\Plugins\Evaluators\FilterTypeInterface;
use Zingular\Forms\Plugins\Evaluators\ValidatorInterface;
use Zingular\Forms\Plugins\Evaluators\ValidatorTypeInterface;
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
     * @param ValidatorTypeInterface $validator
     */
    public function addValidatorType(ValidatorTypeInterface $validator);

    /**
     * @param FilterTypeInterface $filter
     */
    public function addFilterType(FilterTypeInterface $filter);

    /**
     * @param BuilderTypeInterface $builder
     */
    public function addBuilderType(BuilderTypeInterface $builder);

    // TODO: remove here and add only to Construct, since it makes no sense to add form builder factory to a form
    /**
     * @param FormBuilderInterface $builder
     */
    public function addFormBuilderType(FormBuilderInterface $builder);

    /**
     * @param AggregatorTypeInterface $aggregator
     */
    public function addAggregatorType(AggregatorTypeInterface $aggregator);

    /**
     * @param ConditionTypeInterface $condition
     */
    public function addConditionType(ConditionTypeInterface $condition);

    /**
     * @param ConverterTypeInterface $converter
     */
    public function addConverterType(ConverterTypeInterface $converter);

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

    // TODO: remove here and add only to Construct, since it makes no sense to add form builder factory to a form
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