<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 5-2-2016
 * Time: 22:17
 */

namespace Zingular\Form\Component\Element\Control;

use Zingular\Form\BaseTypes;
use Zingular\Form\Component\FormContext;
use Zingular\Form\InputType;

class Checkbox extends Input
{
    /**
     * @var string
     */
    protected $baseType = BaseTypes::CHECKBOX;

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