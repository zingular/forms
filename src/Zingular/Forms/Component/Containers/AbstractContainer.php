<?php

namespace Zingular\Forms\Component\Containers;
use Zingular\Forms\Component\DescribableInterface;


use Zingular\Forms\Component\ComponentInterface;
use Zingular\Forms\Component\Context;


use Zingular\Forms\Exception\FormException;

/**
 * Class AbstractContainer
 * @package Zingular\Form\Component
 */
abstract class AbstractContainer implements DescribableInterface,PositionableInterface
{
    /**
     * @var array
     */
    protected $components = array();

    /**
     * @var int
     */
    protected $defaultPosition = self::POSITION_END;

    /**
     * @var int
     */
    protected $currentPosition = self::POSITION_END;

    /**
     * @var int
     */
    protected $lastPosition = self::POSITION_END;

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
    protected function adopt($name,ComponentInterface $component,$position = self::POSITION_DEFAULT)
    {
        // store the position as default index
        $index = $position;

        // append after component with specified name
        if(is_string($index))
        {
            // try to lookup component
            $afterIndex = $this->getComponentIndex($index);

            // if target component not found, throw exception
            if(is_null($index))
            {
                throw new FormException(sprintf("Cannot insert component '%s' after component '%s': no such component!",$name,$position));
            }

            // set the index to the after index plus one
            $index = $afterIndex + 1;
        }

        // if index is int at this point
        if(is_int($index) == false)
        {
            throw new FormException(sprintf("Cannot insert component '%s': invalid position type: '%s'",is_scalar($index) ? $index : gettype($index)));
        }

        // load the default position
        if($index === self::POSITION_DEFAULT)
        {
            $index = $this->defaultPosition;
        }

        // after the last inserted index
        if($index === self::POSITION_AFTER_LAST)
        {
            //echo 'after last<br/>';
            $index = max($this->lastPosition + 1,0);
        }



        // prepend
        if($index === self::POSITION_START)
        {
            array_unshift($this->components,$component);
        }
        // append
        elseif($index === self::POSITION_END)
        {
            $this->components[] = $component;
        }
        // any indexed position
        elseif($index > -1)
        {
            $count = count($this->components);

            if($index > $count)
            {
                $index = $count;
            }

            array_splice($this->components,$index,0,array($component));
        }
        // throw exception if incorrect position argument
        else
        {
            throw new FormException(sprintf("Cannot add form component: incorrect position argument value: '%s' (should be -1 for append, any positive or zero int for exact position, or string for insert after compomnent by name)",is_scalar($position) ? $position : gettype($position)));
        }

        // set the context to the component
        $component->setContext($this->createContext($name));

        $this->lastPosition = $index;

        /*
        if($name === 'yow')
        {
            echo 'yow<br/>';
            var_dump($index);
            echo '<hr/>';
        }
        if($name === 'yow2')
        {
            echo 'yow2<br/>';
            var_dump($index);
            echo '<hr/>';
        }
        if($name === 'yow3')
        {
            print_rf($this->describe());
            echo '<br/>';
            echo 'yow3<br/>';
            var_dump($index);
            echo '<hr/>';
        }
        if($name === 'yow4')
        {

            echo 'yow4<br/>';
            var_dump($index);
            echo '<hr/>';


        }

        */
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