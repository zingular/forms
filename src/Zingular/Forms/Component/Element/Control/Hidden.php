<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 9-2-2016
 * Time: 21:26
 */

namespace Zingular\Forms\Component\Element\Control;



use Zingular\Forms\InputType;

/**
 * Class Hidden
 * @package Zingular\Forms\Component\Element\Control
 */
class Hidden extends Input
{
    /**
     * @var string
     */
    protected $inputType = InputType::HIDDEN;
}