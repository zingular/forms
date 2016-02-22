<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 17-2-2016
 * Time: 20:00
 */

namespace Zingular\Form\Service\Evaluation;

/**
 * Interface FilterFactoryInterface
 * @package Zingular\Form\Service\Evaluation
 */
interface FilterFactoryInterface
{
    /**
     * @param string $name
     * @return FilterInterface
     */
    public function create($name);

    /**
     * @param string $name
     * @return bool
     */
    public function has($name);
}