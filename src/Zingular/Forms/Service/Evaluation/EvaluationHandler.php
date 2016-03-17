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
use Zingular\Forms\Exception\InvalidArgumentException;
use Zingular\Forms\Exception\ValidatorException;
use Zingular\Forms\Plugins\Evaluators\CallableFilterType;
use Zingular\Forms\Plugins\Evaluators\CallableValidatorType;

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
     * @param DataUnitComponentInterface $subject
     * @param EvaluatorConfigCollection $collection
     * @return mixed
     * @throws ComponentException
     */
    public function evaluate(DataUnitComponentInterface $subject,EvaluatorConfigCollection $collection)
    {
        $value = $subject->getValue();

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
                throw new ComponentException($subject,$e->getMessage(),$e->getType(),$this->prepareExceptionParams($e->getParams(),$value,$subject));
            }
            // convert form exception to component exception
            catch(FormException $e)
            {
                throw new ComponentException($subject,$e->getMessage(),$e->getType(),$this->prepareExceptionParams($e->getParams(),$value,$subject));
            }
            // catch and convert any other exception, and return it
            catch(\Exception $e)
            {
                throw new ComponentException($subject,$e->getMessage());
            }
        }

        return $value;
    }

    /**
     * @param $args
     * @param $value
     * @param DataUnitComponentInterface $component
     */
    protected function prepareExceptionParams($args,$value,DataUnitComponentInterface $component)
    {
        $args['value'] = $value;
        $args['component'] = $component->getId();
        return $args;
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

        $filter = null;

        if(is_string($evaluator))
        {
            $filter = $this->filters->get($evaluator);
        }
        elseif(is_callable($evaluator))
        {
            $filter = new CallableFilterType('generic',$evaluator);
        }
        else
        {
            throw new InvalidArgumentException("Unknown or incorrect filter type!",'filterType',gettype($filter));
        }

        // compile the argumens
        $args = $this->compileArgs($filter->getParams(),$config->getArgs());

        // actually apply the filter
        return $filter->filter($value,$args);
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
        $validator = null;

        if(is_string($evaluator))
        {
            $validator = $this->validators->get($evaluator);
        }
        elseif(is_callable($evaluator))
        {
            $validator = new CallableValidatorType('generic',$evaluator);
        }
        else
        {
            throw new FormException("Unknown or incorrect validator type!",'validation.unknownType');
        }

        //
        $args = $this->compileArgs($validator->getParams(),$config->getArgs());

        // actually validate
        $valid = $validator->validate($value,$args);

        // if no exception thrown, but FALSE returned, handle that as a validation failure
        if($valid === false)
        {
            throw new ValidatorException($validator->getName(),$args,"Generic validator failed!");
        }

        // execute the validator and collect any return value
        return $valid;
    }

    /**
     * @param array $params
     * @param array $args
     * @return array
     */
    protected function compileArgs(array $params,array $args)
    {
        $argsCount = count($args);
        $paramCount = count($params);

        if($argsCount < $paramCount)
        {
            $params = array_slice($params,0,$argsCount,false);
        }
        elseif($paramCount < $argsCount)
        {
            $args = array_slice($args,0,$paramCount,false);
        }

        return array_combine($params,$args);
    }
}