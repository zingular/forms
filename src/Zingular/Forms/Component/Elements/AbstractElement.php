<?php

namespace Zingular\Forms\Component\Elements;
use Zingular\Forms\Component\ComponentTrait;
use Zingular\Forms\Component\ConditionableInterface;
use Zingular\Forms\Component\ConditionableTrait;
use Zingular\Forms\Component\CssComponentTrait;
use Zingular\Forms\Component\FormState;
use Zingular\Forms\Component\HtmlAttributesInterface;
use Zingular\Forms\Component\HtmlAttributesTrait;
use Zingular\Forms\Component\ViewableComponentInterface;
use Zingular\Forms\Component\ViewSetterTrait;
use Zingular\Forms\Condition;
use Zingular\Forms\Exception\FormException;
use Zingular\Forms\Plugins\Conditions\ConditionGroup;
use Zingular\Forms\Validator;


/**
 * Class AbstractElement
 * @package Zingular\Form\Component\Element
 */
abstract class AbstractElement implements
    ElementInterface,
    HtmlAttributesInterface,
    ViewableComponentInterface,
    ConditionableInterface
{
    use ComponentTrait;
    use ViewSetterTrait;
    use CssComponentTrait;
    use HtmlAttributesTrait;
    use ConditionableTrait;
}