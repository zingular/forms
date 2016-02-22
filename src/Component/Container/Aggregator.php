<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 30-1-2016
 * Time: 14:50
 */

namespace Zingular\Form\Component\Container;
use Zingular\Form\Aggregation;
use Zingular\Form\BaseTypes;
use Zingular\Form\Component\DataUnitInterface;
use Zingular\Form\Component\DataUnitTrait;
use Zingular\Form\Component\FormContext;


use Zingular\Form\Service\Aggregation\AggregatorInterface;
use Zingular\Form\Exception\FormException;
use Zingular\Form\View;

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
     * @var string
     */
    protected $viewName = View::TRANSPARENT;

    /**
     * @var string
     */
    protected $baseType = BaseTypes::AGGREGATOR;

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

        // make sure the value is collected, with the collected default value
        $this->retrieveValue($formContext,$defaultValue);
    }

    /**
     * @param FormContext $formContext
     * @return mixed
     */
    protected function readInput(FormContext $formContext)
    {
        return $this->getAggregationStrategy()->aggregate($this->getValues(),$this);
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
}