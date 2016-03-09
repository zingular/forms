<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 5-3-2016
 * Time: 16:13
 */

namespace Zingular\Forms\Component;


/**
 * Class TestCompoment
 * @package Zingular\Forms\Component
 */
class TestCompoment implements ComponentInterface
{
    // TODO: find a way to render view of custom components that only implement the base interfaces

    /**
     * @var Context
     */
    protected $context;


    /**
     * @param Context $context
     */
    public function setContext(Context $context)
    {
        $this->context = $context;
    }

    /**
     * @param FormContext $formContext
     * @param array $defaultValues
     */
    public function compile(FormContext $formContext, array $defaultValues = array())
    {
        // TODO: Implement compile() method.
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->context->getId();
    }

    /**
     * @return string
     */
    public function getFullId()
    {
        return $this->context->getFullId();
    }

    /**
     * @return array
     */
    public function describe()
    {
        // TODO: Implement describe() method.
    }

    /**
     * @return string
     */
    public function getViewName()
    {
        return 'test';
    }
}