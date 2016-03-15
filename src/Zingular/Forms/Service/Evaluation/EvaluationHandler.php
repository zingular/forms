<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 16-2-2016
 * Time: 20:42
 */

namespace Zingular\Forms\Service\Evaluation;

use Zingular\Forms\Component\DataUnitComponentInterface;
use Zingular\Forms\Exception\ComponentException;
use Zingular\Forms\Exception\AbstractEvaluationException;

use Zingular\Forms\Exception\FormException;
use Zingular\Forms\Exception\ValidationException;
use Zingular\Forms\Plugins\Evaluators\CallableFilter;
use Zingular\Forms\Plugins\Evaluators\CallableValidator;

/**
 * Class EvaluationHandler
 * @package Zingular\Form\Evaluation
 */
class EvaluationHandler
{
    /**
     * @var FilterPool
     */
    protected $filters;

    /**
     * @var ValidatorPool
     */
    protected $validators;

    /**
     * @param FilterPool $filters
     * @param ValidatorPool $validators
     */
    public function __construct(FilterPool $filters,ValidatorPool $validators)
    {
        $this->filters = $filters;
        $this->validators = $validators;
    }

    /**
     * @param mixed $value
     * @param EvaluatorConfigCollection $collection
     * @param DataUnitComponentInterface $subject
     * @return mixed
     * @throws ComponentException
     * @throws AbstractEvaluationException
     */
    public function evaluate($value,EvaluatorConfigCollection $collection,DataUnitComponentInterface $subject)
    {
        // extract the evaluators
        $evaluators = $collection->getEvaluators();

        // process all registered evaluators
        foreach($evaluators as $config)
        {
            try
            {
                if($config instanceof FilterConfig)
                {
                    $value = $this->evaluateFilter($config,$value);
                }
                elseif($config instanceof ValidatorConfig)
                {
                    $this->evaluateValidator($config,$value);
                }
            }
            // re-throw the exception
            catch(AbstractEvaluationException $e)
            {
                throw new ComponentException($subject,$e->getType(),$e->getParams());
            }
            // catch any component-specific exception, and return that
            catch(\Exception $e)
            {
                throw new ComponentException($subject,$e->getMessage());
            }
        }

        /*
        if($value === 'test')
        {
            throw new AbstractEvaluationException($subject,'valueIsTest');
        }
        */

        return $value;
    }

    /**
     * @param FilterConfig $config
     * @param $value
     * @return mixed
     * @throws FormException
     */
    protected function evaluateFilter(FilterConfig $config,$value)
    {
        $evaluator = $config->getEvaluator();

        // TODO: create method to map passed arguments to registered arguments, and on mismatch, throw exception
        // TODO: map passed arguments to registered arguments, and map combine them to key=>value array so they can be used as params for error translation
        // TODO: make pool have factory instead of factory having a pool, so that a custom factory can be set easily, and clean separation of pool logic
        // and so that native filter and validator callbacks can be housed inside the factories

        $filter = null;

        if(is_string($evaluator))
        {
            $filter = $this->filters->get($evaluator);
        }
        elseif(is_callable($evaluator))
        {
            $filter = new CallableFilter('generic',$evaluator);
        }
        else
        {
            throw new FormException("Unknown or incorrect filter type!");
        }

        $value = $filter->filter($value,$config->getArgs());

        return $value;
    }

    /**
     * @param ValidatorConfig $config
     * @param $value
     * @return mixed
     * @throws FormException
     */
    protected function evaluateValidator(ValidatorConfig $config,$value)
    {
        $evaluator = $config->getEvaluator();
        $result = null;
        $validator = null;

        if(is_string($evaluator))
        {
            $validator = $this->validators->get($evaluator);
        }
        elseif(is_callable($evaluator))
        {
            $validator = new CallableValidator('generic',$evaluator);
        }
        else
        {
            throw new FormException("Unknown or incorrect validator type!");
        }

        // execute the validator and collect any return value
        $result = $validator->validate($value,$config->getArgs());

        // if no exception thrown, but FALSE returned, handle that as a validation failure
        if($result === false)
        {
            $params = $validator->compileArgs($config->getArgs());
            $params['value'] = $value;

            throw new ValidationException($validator->getName(),$params);
        }

        return $result;
    }
}