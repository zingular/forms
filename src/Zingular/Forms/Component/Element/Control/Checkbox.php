<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 5-2-2016
 * Time: 22:17
 */

namespace Zingular\Forms\Component\Element\Control;

use Zingular\Forms\Component\FormContext;
use Zingular\Forms\InputType;

/**
 * Class Checkbox
 * @package Zingular\Forms\Component\Element\Control
 */
class Checkbox extends Input
{
    /**
     * @var string
     */
    protected $inputType = InputType::CHECKBOX;

    /**
     * @param FormContext $formContext
     * @return null|string
     */
    protected function readInput(FormContext $formContext)
    {
        return $formContext->hasInput($this->getName());
    }

    /**
     * @return bool
     */
    public function isChecked()
    {
        return $this->value;
    }
}