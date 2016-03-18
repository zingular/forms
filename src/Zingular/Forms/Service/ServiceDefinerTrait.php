<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 16-2-2016
 * Time: 18:33
 */

namespace Zingular\Forms\Service;


use Zingular\Forms\Exception\FormException;
use Zingular\Forms\Plugins\Aggregators\AggregatorTypeInterface;
use Zingular\Forms\Plugins\Builders\Form\FormBuilderInterface;
use Zingular\Forms\Plugins\Conditions\ConditionTypeInterface;
use Zingular\Forms\Plugins\Converters\ConverterTypeInterface;
use Zingular\Forms\Plugins\Evaluators\FilterTypeInterface;
use Zingular\Forms\Plugins\Evaluators\ValidatorTypeInterface;
use Zingular\Forms\Service\Bridge\Orm\OrmHandlerInterface;
use Zingular\Forms\Service\Bridge\View\ViewHandlerInterface;
use Zingular\Forms\Plugins\Builders\Container\BuilderTypeInterface;
use Zingular\Forms\Service\Builder\Form\FormBuilderFactoryInterface;
use Zingular\Forms\Service\Evaluation\FilterFactoryInterface;
use Zingular\Forms\Service\Evaluation\ValidatorFactoryInterface;
use Zingular\Forms\Service\Bridge\Translation\TranslatorInterface;

/**
 * Class ServiceDefinerTrait
 * @package Zingular\Form\Component
 */
trait ServiceDefinerTrait
{
    /**
     * @var ServiceDefinerInterface
     */
    protected $services;

    /**
     * @return ServicesInterface
     * @throws FormException
     */
    protected function getServices()
    {
        if(!isset($this->services))
        {
            throw new FormException(sprintf("Cannot retrieve form services: services not set!"));
        }

        return $this->services;
    }

    /**
     * @param ValidatorTypeInterface $validator
     */
    public function addValidatorType(ValidatorTypeInterface $validator)
    {
        $this->getServices()->addValidatorType($validator);
    }

    /**
     * @param FilterTypeInterface $filter
     */
    public function addFilterType(FilterTypeInterface $filter)
    {
        $this->getServices()->addFilterType($filter);
    }

    /**
     * @param BuilderTypeInterface $builder
     */
    public function addBuilderType(BuilderTypeInterface $builder)
    {
        $this->getServices()->addBuilderType($builder);
    }

    /**
     * @param FormBuilderInterface $builder
     */
    public function addFormBuilderType(FormBuilderInterface $builder)
    {
        $this->getServices()->addFormBuilderType($builder);
    }

    /**
     * @param AggregatorTypeInterface $aggregator
     */
    public function addAggregatorType(AggregatorTypeInterface $aggregator)
    {
        $this->getServices()->addAggregatorType($aggregator);
    }

    /**
     * @param ConditionTypeInterface $condition
     */
    public function addConditionType(ConditionTypeInterface $condition)
    {
        $this->getServices()->addConditionType($condition);
    }

    /**
     * @param ConverterTypeInterface $converter
     */
    public function addConverterType(ConverterTypeInterface $converter)
    {
        $this->getServices()->addConverterType($converter);
    }

    /**
     * @param string $name
     * @param callable $callback
     * @throws FormException
     */
    public function addTranslationKeyWildcard($name,$callback)
    {
        $this->getServices()->addTranslationKeyWildcard($name,$callback);
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