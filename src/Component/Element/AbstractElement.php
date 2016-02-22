<?php

namespace Zingular\Form\Component\Element;
use Zingular\Form\Component\ComponentTrait;
use Zingular\Form\Component\ConditionTrait;
use Zingular\Form\Component\FormContext;
use Zingular\Form\Exception\FormException;
use Zingular\Form\Service\Services;

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