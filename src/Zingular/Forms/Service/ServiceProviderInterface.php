<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 9-3-2016
 * Time: 20:42
 */

namespace Zingular\Forms\Service;

use Zingular\Forms\Compilers\Compiler;
use Zingular\Forms\Compilers\CompilerFactory;
use Zingular\Forms\Compilers\CompilerPool;
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
 * Class ServiceConsumerInterface
 * @package Zingular\Forms\Component
 */
interface ServiceProviderInterface
{
    /**********************************************************************
     * HANDLER GETTERS
     *********************************************************************/

    /**
     * @return ViewHandlerInterface
     */
    public function getViewHandler();

    /**
     * @return RequestHandlerInterface
     */
    public function getRequestHandler();

    /**
     * @return TranslationHandler
     */
    public function getTranslator();

    /**
     * @return CsrfHandlerInterface
     */
    public function getCsrfHandler();

    /**
     * @return PersistenceHandlerInterface
     */
    public function getPersistenceHandler();

    /**
     * @return OrmHandlerInterface
     */
    public function getOrmHandler();

    /**
     * @return EvaluationHandler
     */
    public function getEvaluationHandler();

    /**
     * @return BuilderPool
     */
    public function getBuilders();

    /**
     * @return AggregatorPool
     */
    public function getAggregators();

    /**
     * @return ConverterPool
     */
    public function getConverters();

    /**
     * @return ConditionPool
     */
    public function getConditions();

    /**
     * @return ValidatorPool
     */
    public function getValidators();

    /**
     * @return FilterPool
     */
    public function getFilters();

    /**
     * @return Compiler
     */
    public function getCompiler();

    /**********************************************************************
     * FACTORY GETTERS
     *********************************************************************/

    /**
     * @return ComponentFactory
     */
    public function getComponentFactory();

    /**
     * @return FormBuilderFactoryInterface
     */
    public function getFormBuilderFactory();
}