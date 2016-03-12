<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 2-2-2016
 * Time: 18:23
 */

namespace Zingular\Forms\Service\Aggregation;

use Zingular\Forms\Aggregation;
use Zingular\Forms\Exception\FormException;
use Zingular\Forms\Plugins\Aggregators\AggregatorInterface;
use Zingular\Forms\Plugins\Aggregators\DateTimeAggregator;
use Zingular\Forms\Plugins\Aggregators\DummyAggregator;

/**
 * Class AggregatorFactory
 * @package Zingular\Form\Service\Aggregation
 */
class AggregatorFactory implements AggregatorFactoryInterface
{
    /**
     * @param $type
     * @param array $options
     * @return AggregatorInterface
     * @throws FormException
     */
    public function create($type,array $options = array())
    {
        switch($type)
        {
            case Aggregation::NONE: return new DummyAggregator($options);
            case Aggregation::DATE_TIME_SELECT: return new DateTimeAggregator($options);
        }

        throw new FormException(sprintf("Unknown aggregation strategy: '%s'",$type));
    }
}