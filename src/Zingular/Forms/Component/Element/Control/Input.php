<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 30-1-2016
 * Time: 14:49
 */

namespace Zingular\Forms\Component\Element\Control;

use Zingular\Forms\BaseTypes;
use Zingular\Forms\Component\ComponentInterface;
use Zingular\Forms\Component\RequiredTrait;
use Zingular\Forms\InputType;

/**
 * Class Input
 * @package Zingular\Form\Component\Element\Control
 */
class Input extends AbstractControl implements ComponentInterface
{
    use RequiredTrait;

    /**
     * @var string
     */
    protected $baseType = BaseTypes::INPUT;

    /**
     * @var string
     */
    protected $inputType = InputType::TEXT;

    /**
     * @return string
     */
    public function getInputType()
    {
        return $this->inputType;
    }

    /**
     * @param string $type
     * @return $this
     */
    public function setInputType($type = InputType::TEXT)
    {
        $this->inputType = $type;
        return $this;
    }
}