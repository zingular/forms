<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 29-3-2016
 * Time: 20:55
 */

namespace Zingular\Forms\Component;

/**
 * Interface EvaluatableInterface
 * @package Zingular\Forms\Component
 */
interface EvaluatableInterface extends DataUnitComponentInterface
{
    /**
     * @param callable|string $filter
     * @param ...$args
     * @return $this
     */
    public function addFilter($filter,...$args);

    /**
     * @param callable|string
     * @param ...$args
     * @return $this
     */
    public function addValidator($validator,...$args);

    /**
     * @return array
     */
    public function getEvaluators();
}