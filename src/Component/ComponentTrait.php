<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 30-1-2016
 * Time: 16:53
 */

namespace Zingular\Form\Component;
use Zingular\Form\Component\Container\Container;

/**
 * Class ComponentTrait
 * @package Zingular\Form
 */
trait ComponentTrait
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var FormContext
     */
    protected $formContext;

    /**
     * @var string
     */
    protected $baseType;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $cssBaseTypeClass;

    /**
     * @var string
     */
    protected $cssTypeClass;

    /**
     * @var string
     */
    protected $cssClasses = array();

    /**
     * @var string
     */
    protected $viewName;

    /**
     * @var string
     */
    protected $translationKey;

    /**
     * @return string
     */
    public function getBaseType()
    {
        return $this->baseType;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getFullType()
    {
        $parts = array($this->getBaseType());

        if(!is_null($this->getType()))
        {
            $parts[] = $this->getType();
        }

        $parts[] = $this->getId();

        return implode('.',$parts);
    }

    /**********************************************************************
     * IDENTIFICATION
     *********************************************************************/

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
     * @return string
     */
    public function getIndex()
    {
        return $this->context->getIndex();
    }

    /**
     * @param Context $context
     */
    public function setContext(Context $context)
    {
        $this->context = $context;
    }

    /**********************************************************************
     * MAGIC
     *********************************************************************/

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->context->getFullId();
    }

    /**********************************************************************
     * NAVIGATION
     *********************************************************************/

    /**
     * @return Container
     */
    public function getParent()
    {
        return $this->context->getParent();
    }

    /**
     * @return Container
     */
    public function nextSibling()
    {
        return $this->getParent();
    }

    /**
     * @return Container
     */
    public function back()
    {
        $parent = $this->getParent();
        return !is_null($parent) ? $parent->getParent() : null;
    }

    /**********************************************************************
     * CSS / VIEW
     *********************************************************************/

    /**
     * @return string
     */
    public function getTranslationKey()
    {
        return $this->getFullType();
    }

    /**
     * @param $key
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
    public function getViewName()
    {
        return $this->viewName;
    }

    /**
     * @param $name
     * @return $this
     */
    public function setViewName($name)
    {
        $this->viewName = $name;
        return $this;
    }

    /**
     * @param $class
     * @return $this
     */
    public function setCssTypeClass($class)
    {
        $this->cssTypeClass = $class;
        return $this;
    }

    /**
     * @return string
     */
    public function getCssTypeClass()
    {
        return $this->cssTypeClass;
    }

    /**
     * @param $class
     * @return $this
     */
    public function setCssBaseTypeClass($class)
    {
        $this->cssBaseTypeClass = $class;
        return $this;
    }

    /**
     * @return string
     */
    public function getCssBaseTypeClass()
    {
        return $this->cssBaseTypeClass;
    }

    /**
     * @param $class
     * @return $this
     */
    public function addCssClass($class)
    {
        $this->cssClasses[trim($class)] = true;
        return $this;
    }

    /**
     * @return string
     */
    public function getCssClass()
    {
        $classes = array();

        if(!is_null($this->cssBaseTypeClass))
        {
            $classes[] = $this->cssBaseTypeClass;
        }
        if(!is_null($this->cssTypeClass))
        {
            $classes[] = $this->cssTypeClass;
        }
        return implode(' ',array_merge($classes,array_keys($this->cssClasses)));
    }
}