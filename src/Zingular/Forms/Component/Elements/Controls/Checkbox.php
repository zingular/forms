<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 5-2-2016
 * Time: 22:17
 */

namespace Zingular\Forms\Component\Elements\Controls;

use Zingular\Forms\Component\FormState;
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
     * @param FormState $state
     * @return null|string
     */
    protected function readInput(FormState $state)
    {
        return $state->hasInput($this->getName());
    }

    /**
     * @return bool
     */
    public function isChecked()
    {
        return $this->value;
    }
}