<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 20:32
 */

namespace Zingular\Forms\Service\Aggregation;

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

    /**
     * @param string $name
     * @return bool
     */
    public function has($name);
}