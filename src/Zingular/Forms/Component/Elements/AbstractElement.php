<?php

namespace Zingular\Forms\Component\Elements;
use Zingular\Forms\Component\ComponentTrait;
use Zingular\Forms\Component\ConditionableInterface;
use Zingular\Forms\Component\ConditionableTrait;
use Zingular\Forms\Component\CssComponentTrait;
use Zingular\Forms\Component\HtmlAttributesInterface;
use Zingular\Forms\Component\HtmlAttributesTrait;
use Zingular\Forms\Component\TranslatableComponentInterface;
use Zingular\Forms\Component\TranslatableComponentTrait;
use Zingular\Forms\Component\TypedComponentInterface;
use Zingular\Forms\Component\TypedComponentTrait;
use Zingular\Forms\Component\ViewableComponentInterface;
use Zingular\Forms\Component\ViewSetterTrait;
use Zingular\Forms\Events\EventDispatcherInterface;
use Zingular\Forms\Events\EventDispatcherTrait;

/**
 * Class AbstractElement
 * @package Zingular\Form\Component\Element
 */
abstract class AbstractElement implements
    ElementInterface,
    HtmlAttributesInterface,
    ViewableComponentInterface,
    ConditionableInterface,
    EventDispatcherInterface,
    TranslatableComponentInterface,
    TypedComponentInterface
{
    use ComponentTrait;
    use ViewSetterTrait;
    use CssComponentTrait;
    use HtmlAttributesTrait;
    use ConditionableTrait;
    use EventDispatcherTrait;
    use TranslatableComponentTrait;
    use TypedComponentTrait;
}