<?php

namespace Zingular\Forms\Component\Elements;
use Zingular\Forms\Component\ComponentTrait;
use Zingular\Forms\Component\ConditionableInterface;
use Zingular\Forms\Component\ConditionableTrait;
use Zingular\Forms\Component\CssComponentTrait;
use Zingular\Forms\Component\ErrorComponentInterface;
use Zingular\Forms\Component\ErrorComponentTrait;
use Zingular\Forms\Component\HtmlAttributesInterface;
use Zingular\Forms\Component\HtmlAttributesTrait;
use Zingular\Forms\Component\TranslatableComponentInterface;
use Zingular\Forms\Component\TypedComponentInterface;
use Zingular\Forms\Component\TypedComponentTrait;
use Zingular\Forms\Component\ViewableComponentInterface;
use Zingular\Forms\Component\ViewSetterTrait;

use Zingular\Forms\Events\EventDispatcherInterface;
use Zingular\Forms\Events\EventDispatcherTrait;
use Zingular\Forms\Exception\FormException;

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
    TypedComponentInterface,
    ErrorComponentInterface
{
    use ComponentTrait;
    use ViewSetterTrait;
    use CssComponentTrait;
    use HtmlAttributesTrait;
    use ConditionableTrait;
    use EventDispatcherTrait;
    use TypedComponentTrait;
    use ErrorComponentTrait;

    /**
     * @var string
     */
    protected $translationKey = '{parentId}.{name}';

    /***************************************************************
     * TRANSLATION
     **************************************************************/

    /**
     * @param string $key
     * @return $this
     */
    public function setTranslationKey($key)
    {
        $this->translationKey = $key;
        return $this;
    }

    /**
     * @return string
     */
    public function getTranslationKey()
    {
        return $this->translationKey;
    }

    /***************************************************************
     * C:ONING
     **************************************************************/

    /**
     *
     */
    public function __clone()
    {
        // cannot clone a container when it is already used in a form runtime
        if(!is_null($this->state))
        {
            throw new FormException(sprintf("Cannot clone component during form processing: '%s'",$this->getId()));
        }
    }
}