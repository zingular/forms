<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 20:23
 */

namespace Zingular\Forms\Component;

/**
 * Interface DataInterface
 * @package Zingular\Forms\Component
 */
interface DataInterface extends ComponentInterface
{
    /**
     * @param State $state
     * @param array $defaultValues
     */
    public function compile(State $state,array $defaultValues = array());
}