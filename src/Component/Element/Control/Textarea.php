<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 30-1-2016
 * Time: 14:49
 */

namespace Zingular\Form\Component\Element\Control;

use Zingular\Form\BaseTypes;
use Zingular\Form\Component\ComponentInterface;
use Zingular\Form\Component\RequiredTrait;

/**
 * Class Textarea
 * @package Zingular\Form\Component\Element\Control
 */
class Textarea extends AbstractControl implements ComponentInterface
{
    use RequiredTrait;

    /**
     * @var string
     */
    protected $baseType = BaseTypes::TEXTAREA;
}