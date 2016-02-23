<?php

namespace Zingular\Forms\Component\Element;
use Zingular\Forms\Component\ComponentTrait;
use Zingular\Forms\Component\ConditionTrait;
use Zingular\Forms\Component\HtmlAttributesTrait;

/**
 * Class AbstractElement
 * @package Zingular\Form\Component\Element
 */
abstract class AbstractElement implements ElementInterface
{
    use ConditionTrait;
    use ComponentTrait;
    use HtmlAttributesTrait;

    /**********************************************************************
     * VIEW
     *********************************************************************/


}