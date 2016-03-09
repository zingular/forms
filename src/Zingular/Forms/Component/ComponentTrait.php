<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 30-1-2016
 * Time: 16:53
 */

namespace Zingular\Forms\Component;
use Zingular\Forms\Component\Container\Container;
use Zingular\Forms\Exception\FormException;
use Zingular\Forms\Service\Services;

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
    protected $cssBaseTypeClass = '';

    /**
     * @var string
     */
    protected $cssTypeClass = '';

    /**
     * @var string
     */
    protected $cssClasses = array();

    /**
     * @var string
     */
    protected $viewName;

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
     * @param int $level
     * @return Container
     */
    public function getParent($level = 1)
    {
        $parent = $this->context->getParent();

        if(is_null($parent))
        {
            return null;
        }

        $currentLevel = 1;

        while($currentLevel < $level)
        {
            $parent = $parent->getParent();

            if(is_null($parent))
            {
                return null;
            }

            $currentLevel++;
        }
        return $parent;
    }

    /**
     * @return Container
     */
    public function next()
    {
        return $this->getParent();
    }


    /**
     * @param int $level
     * @return Container
     */
    public function nextParent($level = 1)
    {
        return $this->getParent($level + 1);
    }



    /**********************************************************************
     * CSS / VIEW
     *********************************************************************/

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
        $class = trim($class);

        if(strlen($class))
        {
            $this->cssClasses[trim($class)] = true;
        }

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

        $classes = array_merge($classes,array_keys($this->cssClasses),$this->getRuntimeClasses());
        array_walk($classes,'trim');
        $classes = array_filter($classes,'strlen');
        return implode(' ',$classes);
    }

    /**
     * @return array
     */
    protected function getRuntimeClasses()
    {
        return array();
    }

    /**
     * @return ServiceGetterInterface
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