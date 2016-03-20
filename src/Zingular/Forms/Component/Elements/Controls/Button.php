<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 30-1-2016
 * Time: 14:49
 */

namespace Zingular\Forms\Component\Elements\Controls;
use Zingular\Forms\ButtonType;

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
     * @var string
     */
    protected $type = ButtonType::SUBMIT;

    /**
     * @param callable $callable
     * @return $this
     */
    public function onClick(callable $callable)
    {
        $this->callbacks[] = $callable;
        return $this;
    }

    /**
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}