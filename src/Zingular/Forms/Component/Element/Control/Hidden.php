<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 9-2-2016
 * Time: 21:26
 */

namespace Zingular\Forms\Component\Element\Control;


use Zingular\Forms\BaseTypes;
use Zingular\Forms\InputType;

class Hidden extends Input
{
    /**
     * @var string
     */
    protected $baseType = BaseTypes::HIDDEN;

    /**
     * @var string
     */
    protected $inputType = InputType::HIDDEN;
}