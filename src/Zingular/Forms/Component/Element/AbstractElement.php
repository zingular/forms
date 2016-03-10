<?php

namespace Zingular\Forms\Component\Element;
use Zingular\Forms\Component\ComponentTrait;
use Zingular\Forms\Component\ConditionTrait;
use Zingular\Forms\Component\CssComponentTrait;
use Zingular\Forms\Component\HtmlAttributesInterface;
use Zingular\Forms\Component\HtmlAttributesTrait;
use Zingular\Forms\Component\ViewableComponentInterface;
use Zingular\Forms\Component\ViewSetterTrait;

/**
 * Class AbstractElement
 * @package Zingular\Form\Component\Element
 */
abstract class AbstractElement implements ElementInterface,HtmlAttributesInterface,ViewableComponentInterface
{
    use ComponentTrait;
    use ViewSetterTrait;
    use CssComponentTrait;
    use ConditionTrait;
    use HtmlAttributesTrait;

    /**********************************************************************
     * VIEW
     *********************************************************************/

}