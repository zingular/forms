<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 30-1-2016
 * Time: 14:50
 */

namespace Zingular\Forms\Component\Container;
use Zingular\Forms\Aggregation;
use Zingular\Forms\Component\AggregatorAbstractValueRetriever;
use Zingular\Forms\Component\DataUnitInterface;
use Zingular\Forms\Component\DataUnitTrait;
use Zingular\Forms\Component\FormContext;
use Zingular\Forms\Service\Aggregation\AggregatorInterface;
use Zingular\Forms\Exception\FormException;

/**
 * Class Aggregator
 * @package Zingular\Form
 */
class Aggregator extends Container implements DataUnitInterface
{
    use DataUnitTrait;

    /**
     * @var AggregatorInterface
     */
    protected $aggregationStrategy;

    /**
     * @var string
     */
    protected $aggregationStrategyType = Aggregation::NONE;

    /**
     * @param FormContext $formContext
     * @param array $defaultValues
     * @return string
     */
    public function compile(FormContext $formContext,array $defaultValues = array())
    {
        // store the form context locally
        $this->formContext = $formContext;

        // default value
        $defaultValue = null;

        // extract the default value for this aggregator from the default values
        if(array_key_exists($this->getName(),$defaultValues))
        {
            // set the default value from the set value
            $defaultValue = $defaultValues[$this->getName()];

            // overwrite the default values by de-aggregating the default value
            $defaultValues = $this->getAggregationStrategy()->deaggegate($defaultValue,$this);

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

        // compile the parent using the de-aggregated value as default values for child components
        parent::compile($formContext,$defaultValues);


        $retriever = new AggregatorAbstractValueRetriever($this,$formContext,$this->getEvaluatorCollection());
        $retriever->setAggregator($this->getAggregationStrategy());


        $this->value = $retriever->retrieveValue($defaultValue);


        // make sure the value is collected, with the collected default value
        //$this->retrieveValue($formContext,$defaultValue);
    }



    /**
     * @param string $strategy
     * @return $this
     */
    public function setAggregationType($strategy)
    {
        $this->aggregationStrategyType = $strategy;
        return $this;
    }

    /**
     * @return AggregatorInterface
     * @throws FormException
     */
    protected function getAggregationStrategy()
    {
        if(is_null($this->aggregationStrategy))
        {
            $this->aggregationStrategy = $this->getServices()->getAggregators()->get($this->aggregationStrategyType);
        }
        return $this->aggregationStrategy;
    }

        /**
     * @return array
     */
    protected function describeSelf()
    {
        return array_merge(parent::describeSelf(),array('aggregationStrategyType'=>$this->aggregationStrategyType));
    }

    /**
     * @return string
     */
    public function getDataPath()
    {
        return trim($this->context->getDataPath().'/'.$this->getName(),'/');
    }

    /**
     * @param $converter
     * @param $args
     * @return $this
     */
    public function setConverter($converter,...$args)
    {
        // TODO
    }
}