<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 30-1-2016
 * Time: 14:49
 */

namespace Zingular\Forms\Component\Elements\Controls;

/**
 * Class Button
 * @package Zingular\Form\Component\Element\Control
 */
class Button extends AbstractControl
{
    /**
     * @var array
     */
    protected $callbacks = array();

    /**
     * @param callable $callable
     * @return $this
     */
    public function onClick(callable $callable)
    {
        $this->callbacks[] = $callable;
        return $this;
    }
}