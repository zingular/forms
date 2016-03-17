<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 2-2-2016
 * Time: 18:21
 */

namespace Zingular\Forms\Plugins\Aggregators;
use Zingular\Forms\Component\Containers\Aggregator;

/**
 * Interface AggregatorInterface
 * @package Zingular\Form
 */
interface AggregatorInterface
{
    /**
     * @param array $values
     * @param Aggregator $aggregator
     * @param array $options
     * @return mixed
     */
    public function aggregate(array $values,Aggregator $aggregator,array $options = array());

    /**
     * @param $value
     * @param Aggregator $aggregator
     * @param array $options
     * @return array
     */
    public function deaggegate($value,Aggregator $aggregator,array $options = array());
}