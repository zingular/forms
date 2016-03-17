<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 2-2-2016
 * Time: 19:36
 */

namespace Zingular\Forms\Plugins\Aggregators;
use Zingular\Forms\Component\Containers\Aggregator;

/**
 * Class DateTimeAggregator
 * @package Zingular\Form
 */
class DateTimeAggregator implements AggregatorInterface
{
    /**
     * @param array $values
     * @param Aggregator $aggregator
     * @param array $options
     * @return mixed
     */
    public function aggregate(array $values,Aggregator $aggregator,array $options = array())
    {
        return mktime(0,0,0,(int) $values['n'],(int) $values['j'],(int) $values['Y']);
    }

    /**
     * @param mixed $value
     * @param Aggregator $aggregator
     * @param array $options
     * @return array
     */
    public function deaggegate($value,Aggregator $aggregator,array $options = array())
    {
        return array('j'=>date('j',$value),'n'=>date('n',$value),'Y'=>date('Y',$value));
    }
}