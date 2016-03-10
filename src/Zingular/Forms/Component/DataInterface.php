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
     * @param FormState $state
     * @param array $defaultValues
     */
    public function compile(FormState $state,array $defaultValues = array());
}