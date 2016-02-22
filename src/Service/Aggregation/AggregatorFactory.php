<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 2-2-2016
 * Time: 18:23
 */

namespace Zingular\Form\Service\Aggregation;

use Zingular\Form\Aggregation;
use Zingular\Form\Exception\FormException;

/**
 * Class AggregatorFactory
 * @package Zingular\Form\Service\Aggregation
 */
class AggregatorFactory implements AggregatorFactoryInterface
{
    /**
     * @var array
     */
    protected $types = array
    (
        Aggregation::NONE,
        Aggregation::DATE_TIME_SELECT
    );

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

    /**
     * @param string $name
     * @return bool
     */
    public function has($name)
    {
        return in_array($name,$this->types);
    }
}