<?php

namespace Zingular\Forms\Component\Containers;
use Zingular\Forms\Component\DescribableInterface;
use Zingular\Forms\Component\Elements\Controls\Button;
use Zingular\Forms\Component\Elements\Controls\Checkbox;
use Zingular\Forms\Component\Elements\Controls\Select;
use Zingular\Forms\Component\Elements\Controls\Textarea;
use Zingular\Forms\Component\ComponentInterface;
use Zingular\Forms\Component\Context;
use Zingular\Forms\Component\Elements\Controls\Input;


use Zingular\Forms\Exception\FormException;

/**
 * Class AbstractContainer
 * @package Zingular\Form\Component
 */
abstract class AbstractContainer implements DescribableInterface
{
    /**
     * @var array
     */
    protected $components = array();

    /***************************************************************
     * CLONING
     **************************************************************/

    /**
     *
     */
    public function __clone()
    {
        // clone all child components as well
        array_walk($this->components,function(ComponentInterface &$component)
        {
            // store the child componment id before cloning it (cloning will unset the component context)
            $id = $component->getId();

            // actually clone the child component
            $component = clone $component;

            // set a new context for this (cloned) container
            $component->setContext($this->createContext($id));
        });
    }

    /***************************************************************
     * GENERAL
     **************************************************************/

    /**
     * @param $name
     * @param ComponentInterface $component
     * @param int|string $position
     * @return ComponentInterface
     * @throws FormException
     */
    protected function adopt($name,ComponentInterface $component,$position = -1)
    {
        // append
        if($position === -1)
        {
            $this->components[] = $component;
        }
        // prepend
        elseif($position === 0)
        {
            array_unshift($this->components,$component);
        }
        // any indexed position
        elseif(is_int($position) && $position > -1)
        {
            $count = count($this->components);

            if($position > $count)
            {
                $position = $count;
            }

            array_splice($this->components,$position,0,array($component));
        }
        // append after component with specified name
        elseif(is_string($position))
        {
            // try to lookup component
            $index = $this->getComponentIndex($position);

            // if target component not found, throw exception
            if(is_null($index))
            {
                throw new FormException(sprintf("Cannot insert component after component '%s': no such component!",$position));
            }

            // recursive call with new index as target position
            return $this->adopt($name,$component,$index + 1);
        }
        // throw exception if incorrect position argument
        else
        {
            throw new FormException(sprintf("Cannot add form component: incorrect position argument value: '%s' (should be -1 for append, any positive or zero int for exact position, or string for insert after compomnent by name)",is_scalar($position) ? $position : gettype($position)));
        }

        // set the context to the component
        $component->setContext($this->createContext($name));

        return $component;
    }

    /**
     * @param string $name
     * @param string $type
     * @return bool
     */
    public function hasComponent($name,$type = null)
    {
        $index = $this->getComponentIndex($name);

        if(is_null($index))
        {
            return false;
        }

        return is_null($type) || get_class($this->components[$index]) === $type;
    }

    /**
     * @param $name
     * @return mixed
     * @throws FormException
     */
    public function getComponentIndex($name)
    {
        return key(array_filter($this->components,function(ComponentInterface $component) use ($name) {return $component->getId() === $name;}));
    }

    /**
     * @param $name
     * @return $this
     */
    public function removeComponent($name)
    {
        $index = $this->getComponentIndex($name);

        if(!is_null($index))
        {
            unset($this->components[$index]);
            $this->components = array_values($this->components);
        }

        return $this;
    }

    /**
     * @param $id
     * @return Context
     */
    abstract protected function createContext($id);

    /**
     * @param $name
     * @param string $type
     * @return ComponentInterface
     * @throws FormException
     */
    protected function getComponent($name,$type = null)
    {
        $index = $this->getComponentIndex($name);

        if($index === false)
        {
            $index = -1;
        }

        $candidate = isset($this->components[$index]) ? $this->components[$index] : null;

        if(is_null($candidate))
        {
            throw new FormException(sprintf("Cannot retrieve component from container: unknown component '%s'",$name),'component.unknown');
        }
        elseif(!is_null($type) && !($candidate instanceof $type))
        {
            throw new FormException(sprintf("Cannot retrieve component from container: component '%s' not of specified type '%s'",$name,$type),'component.wrongType');
        }

        return $candidate;
    }

    /**
     * @param $name
     * @return ComponentInterface
     * @throws FormException
     */
    protected function cloneComponent($name)
    {
        return clone $this->getComponent($name);
    }

    /**
     * @param $name
     * @return string
     * @throws FormException
     */
    public function getComponentType($name)
    {
        return get_class($this->getComponent($name));
    }

    /**
     * @param $name
     * @param $type
     * @return bool
     * @throws FormException
     */
    public function componentIsOfType($name,$type)
    {
        return $this->getComponent($name) instanceof $type;
    }

    /**
     * @return array
     */
    public function describe()
    {
        $data = $this->describeSelf();

        foreach($this->components as $component)
        {
            if($component instanceof ComponentInterface)
            {
                $id = $component->getId();

                if($component instanceof DescribableInterface)
                {
                    $data['children'][$id] = $component->describe();
                }
                else
                {
                    $data['children'][$id] = array
                    (
                        'type'=>get_class($component)
                    );
                }
            }
        }

        ksort($data);

        return $data;
    }

    /**
     * @return array
     */
    protected function describeSelf()
    {
        return array
        (
            'type'=>get_class($this),
            'children'=>array()
        );
    }

}