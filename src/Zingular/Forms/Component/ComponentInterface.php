<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 30-1-2016
 * Time: 14:34
 */

namespace Zingular\Forms\Component;

/**
 * Interface ComponentInterface
 * @package Zingular\Form
 */
interface ComponentInterface
{
    /**
     * @param Context $context
     */
    public function setContext(Context $context);

    /**
     * @param FormContext $formContext
     * @param array $defaultValues
     */
    public function compile(FormContext $formContext,array $defaultValues = array());

    /**
     * @return string
     */
    public function getId();

    /**
     * @return string
     */
    public function getFullId();

    /**
     * @return array
     */
    public function describe();

    /**
     * @return string
     */
    public function getViewName();
}