<?php

namespace Zingular\Forms\Component\Element;
use Zingular\Forms\Component\ComponentTrait;
use Zingular\Forms\Component\ConditionTrait;
use Zingular\Forms\Component\FormContext;
use Zingular\Forms\Exception\FormException;
use Zingular\Forms\Service\Services;

/**
 * Class AbstractElement
 * @package Zingular\Form\Component\Element
 */
abstract class AbstractElement implements ElementInterface
{
    use ConditionTrait;
    use ComponentTrait;

    /**
     * @var FormContext
     */
    protected $formContext;

    /**********************************************************************
     * VIEW
     *********************************************************************/

    /**
     * @return Services
     */
    protected function getServices()
    {
        return $this->formContext->getServices();
    }

    /**
     * @throws FormException
     */
    public function __clone()
    {
        // cannot clone a container when it is already used in a form runtime
        if(!is_null($this->formContext))
        {
            throw new FormException(sprintf("Cannot clone component during form processing: '%s'",$this->getId()));
        }

        // unset the current context
        $this->context = null;
    }
}