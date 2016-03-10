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
     * @var State
     */
    protected $state;


    /**
     * @param Context $context
     */
    public function setContext(Context $context)
    {
        $this->context = $context;
    }

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

    /**
     * @return Context
     */
    protected function getContext()
    {
        if(isset($this->context))
        {
            return $this->context;
        }

        return null;
    }

    /**********************************************************************
     * IDENTIFICATION
     *********************************************************************/

    /**
     * @return string
     */
    public function getId()
    {
        return $this->getContext()->getId();
    }

    /**
     * @return string
     */
    public function getFullId()
    {
        return $this->getContext()->getFullId();
    }

    /**
     * @return string
     */
    public function getIndex()
    {
        return $this->getContext()->getIndex();
    }

    /**********************************************************************
     * MAGIC
     *********************************************************************/

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getContext()->getFullId();
    }

    /**********************************************************************
     * CSS / VIEW
     *********************************************************************/

    /**
     * @return ServiceGetterInterface
     */
    protected function getServices()
    {
        return $this->state->getServices();
    }

    /**
     * @throws FormException
     */
    public function __clone()
    {
        // cannot clone a container when it is already used in a form runtime
        if(!is_null($this->state))
        {
            throw new FormException(sprintf("Cannot clone component during form processing: '%s'",$this->getId()));
        }

        // unset the current context
        if(isset($this->context))
        {
            $this->context = null;
        }
    }
}