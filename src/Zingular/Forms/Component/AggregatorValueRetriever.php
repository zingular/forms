<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 24-2-2016
 * Time: 20:46
 */

namespace Zingular\Forms\Component;

use Zingular\Forms\Component\Container\Aggregator;
use Zingular\Forms\Service\Aggregation\AggregatorInterface;
use Zingular\Forms\Service\Evaluation\EvaluatorConfigCollection;

class AggregatorAbstractValueRetriever extends AbstractValueRetriever
{
    /**
     * @var AggregatorInterface
     */
    protected $aggregator;

    /**
     * @var Aggregator
     */
    protected $aggregatorComponent;

    /**
     * @param DataUnitInterface $component
     * @param FormContext $context
     * @param EvaluatorConfigCollection $evaluators
     */
    public function __construct(DataUnitInterface $component,FormContext $context,EvaluatorConfigCollection $evaluators)
    {
        parent::__construct($component,$context,$evaluators);
        $this->aggregatorComponent = $component;
    }

    /**
     * @param AggregatorInterface $aggregator
     */
    public function setAggregator(AggregatorInterface $aggregator)
    {
        $this->aggregator = $aggregator;
    }

    /**
     * @param FormContext $formContext
     * @return mixed
     */
    protected function readInput(FormContext $formContext)
    {
        return $this->aggregator->aggregate($this->aggregatorComponent->getValues(),$this->aggregatorComponent);
    }


}