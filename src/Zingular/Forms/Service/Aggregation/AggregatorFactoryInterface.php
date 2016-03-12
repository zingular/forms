<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 20:32
 */

namespace Zingular\Forms\Service\Aggregation;
use Zingular\Forms\Plugins\Aggregators\AggregatorInterface;

/**
 * Interface AggregatorFactoryInterface
 * @package Zingular\Form\Service\Aggregation
 */
interface AggregatorFactoryInterface
{
    /**
     * @param $name
     * @return AggregatorInterface
     */
    public function create($name);
}