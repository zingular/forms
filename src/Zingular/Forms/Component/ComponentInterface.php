<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 30-1-2016
 * Time: 14:34
 */

namespace Zingular\Forms\Component;
use Zingular\Forms\Component\Container\Container;

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
     * @return
     */
    public function compile(FormContext $formContext,array $defaultValues = array());

    /**
     * @return string
     */
    public function getBaseType();

    /**
     * @return string
     */
    public function getType();

    /**
     * @param string $type
     */
    public function setType($type);

    /**
     * @return string
     */
    public function getFullType();

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

    /**
     * @return string
     */
    public function getTranslationKey();

    /**
     * @param $key
     * @return $this
     */
    public function setTranslationKey($key);

    /**
     * @param $class
     * @return $this
     */
    public function setCssBaseTypeClass($class);

    /**
     * @return string
     */
    public function getCssBaseTypeClass();

    /**
     * @param $class
     * @return $this
     */
    public function setCssTypeClass($class);

    /**
     * @return string
     */
    public function getCssClass();

    /**
     * @param string $class
     * @return $this
     */
    public function addCssClass($class);
    /**
     * @return string
     */
    public function getCssTypeClass();

    /**
     * @return Container
     */
    public function getParent();

    /**
     * @return Container
     */
    public function nextSibling();

    /**
     * @return Container
     */
    public function back();
}