<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 2-2-2016
 * Time: 19:36
 */

namespace Zingular\Forms\Plugins\Aggregators;
use Zingular\Forms\Component\Container\Aggregator;


/**
 * Class DateTimeAggregator
 * @package Zingular\Form
 */
class DateTimeAggregator extends AbstractAggregator
{
    /**
     * @var array
     */
    protected $defaultOptions = array
    (
        'format'=>'j-n-Y'
    );

    /**
     * @param array $values
     * @param Aggregator $aggregator
     * @return mixed
     */
    public function aggregate(array $values,Aggregator $aggregator)
    {
        return mktime(0,0,0,(int) $values['n'],(int) $values['j'],(int) $values['Y']);
    }

    /**
     * @param mixed $value
     * @param Aggregator $aggregator
     * @return array
     */
    public function deaggegate($value,Aggregator $aggregator)
    {
        return array('j'=>date('j',$value),'n'=>date('n',$value),'Y'=>date('Y',$value));
    }
}