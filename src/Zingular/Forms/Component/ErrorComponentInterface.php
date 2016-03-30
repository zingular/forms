<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 30-3-2016
 * Time: 20:37
 */

namespace Zingular\Forms\Component;
use Zingular\Forms\Exception\FormException;

/**
 * Interface ErrorComponentInterface
 * @package Zingular\Forms\Component
 */
interface ErrorComponentInterface
{
    /**
     * @return bool
     */
    public function hasErrors();

    /**
     * @return array
     */
    public function getErrors();

    /**
     * @param FormException $e
     * @return $this
     */
    public function addError(FormException $e);
}