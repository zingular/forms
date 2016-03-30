<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 30-3-2016
 * Time: 19:26
 */

namespace Zingular\Forms\Compilers;
use Zingular\Forms\Component\Containers\Aggregator;
use Zingular\Forms\Component\DataUnitComponentInterface;
use Zingular\Forms\Component\FormState;
use Zingular\Forms\Exception\ComponentException;

/**
 * Class AggregatorCompiler
 * @package Zingular\Forms\Compilers
 */
class AggregatorCompiler
{
    /**
     * @var ContainerCompiler
     */
    protected $containerCompiler;

    /**
     * @var ControlCompiler
     */
    protected $controlCompiler;

    /**
     * @param ContainerCompiler $containerCompiler
     * @param ControlCompiler $controlCompiler
     */
    public function __construct(ContainerCompiler $containerCompiler,ControlCompiler $controlCompiler)
    {
        $this->containerCompiler = $containerCompiler;
        $this->controlCompiler = $controlCompiler;
    }

    /**
     * @param Compiler $compiler
     * @param Aggregator $input
     * @param FormState $state
     * @param array $defaultValues
     * @throws ComponentException
     */
    public function compile(Compiler $compiler,Aggregator $input,FormState $state,array $defaultValues)
    {
        $aggregatorType = $input->getAggregationStrategy();

        $aggregatorStrategy = $state->getServices()->getAggregators()->get($aggregatorType);

        // default value
        $defaultValue = null;

        // extract the default value for this aggregator from the default values
        if(array_key_exists($input->getName(),$defaultValues))
        {
            // set the default value from the set value
            $defaultValue = $defaultValues[$input->getName()];

            // overwrite the default values by de-aggregating the default value
            //$defaultValues = $this->deaggregate($this->decodeValue($defaultValue));//$this->getAggregationStrategy()->deaggegate($this->decodeValue($defaultValue),$this);
            $defaultValues = $aggregatorStrategy->deaggegate($defaultValue,$input);//$this->deaggregate($defaultValue);//$this->getAggregationStrategy()->deaggegate($this->decodeValue($defaultValue),$this);


            // TODO: apply native deaggregation here

            if(!is_array($defaultValues))
            {
                $defaultValues = array();
            }
        }
        // if there was no default value provided for this aggregator, there are no default values to be set for childs
        else
        {
            $defaultValues = array();
        }

        // compile as container
        $this->containerCompiler->compile($compiler,$input,$state,$defaultValues);

        // compile as control
        $this->controlCompiler->compile($input,$state,$defaultValue);
    }



    /**
     * @param Aggregator $input
     * @param FormState $state
     * @return null|string
     */
    protected function readInput(Aggregator $input,FormState $state)
    {
        $raw = $input->values;

        // todo: check required mode

        $aggregatorType = $input->getAggregationStrategy();

        $aggregatorStrategy = $state->getServices()->getAggregators()->get($aggregatorType);


        $aggregated = $aggregatorStrategy->aggregate($raw,$input);

        return $aggregated;
    }

    /**
     * @param DataUnitComponentInterface $input
     * @param FormState $state
     * @return bool
     */
    protected function shouldReadInput(DataUnitComponentInterface $input,FormState $state)
    {
        return $state->hasSubmit() && !$input->hasFixedValue();
    }
}