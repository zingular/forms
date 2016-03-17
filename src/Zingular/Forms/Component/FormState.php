<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 31-1-2016
 * Time: 20:17
 */

namespace Zingular\Forms\Component;

use Zingular\Forms\Component\Containers\Container;
use Zingular\Forms\Component\Containers\ContainerInterface;
use Zingular\Forms\Component\Containers\Form;
use Zingular\Forms\Service\ServiceProviderInterface;

/**
 * Class FormState
 * @package Zingular\Form
 */
class FormState
{
    /**
     * @var Form
     */
    protected $form;

    /**
     * @var ServiceProviderInterface
     */
    protected $services;

    /**
     * @var array
     */
    protected $values = array();

    /**
     * @var array
     */
    protected $componentsByName = array();

    /**
     * @var array
     */
    protected $componentsById = array();

    /**
     * @param Form $form
     * @param ServiceProviderInterface $services
     */
    public function __construct(Form $form,ServiceProviderInterface $services)
    {
        $this->form = $form;
        $this->services = $services;
    }

    /**
     * @param $name
     * @param ContainerInterface $parent
     * @return mixed
     */
    public function getValue($name,ContainerInterface $parent = null)
    {
        // first, make sure the path is absolute
        $name = $this->makeNameAbsolute($name,$parent);

        // return the value if it exists
        return array_key_exists($name,$this->values) ? $this->values[$name] : null;
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return array_filter($this->values,function($key){return strpos($key,'/') === false;},ARRAY_FILTER_USE_KEY);
    }

    /**
     * @param $name
     * @param Container $parent
     * @return bool
     */
    public function hasValue($name,Container $parent = null)
    {
        return array_key_exists($this->makeNameAbsolute($name,$parent),$this->values);
    }

    /**
     * @param $name
     * @param ContainerInterface $parent
     * @return bool
     */
    public function hasComponentByName($name,ContainerInterface $parent = null)
    {
        return array_key_exists($this->makeNameAbsolute($name,$parent),$this->componentsByName);
    }

    /**
     * @param $name
     * @param ContainerInterface $parent
     * @return DataUnitComponentInterface
     */
    public function getComponentByName($name,ContainerInterface $parent = null)
    {
        // first, make sure the path is absolute
        $name = $this->makeNameAbsolute($name,$parent);

        // return the value if it exists
        return array_key_exists($name,$this->componentsByName) ? $this->componentsByName[$name] : null;
    }

    /**
     * @param $id
     * @param ContainerInterface $parent
     * @return bool
     */
    public function hasComponentById($id,ContainerInterface $parent = null)
    {
        return array_key_exists($this->makeNameAbsolute($id,$parent),$this->componentsById);
    }

    /**
     * @param $id
     * @param ContainerInterface $parent
     * @return ComponentInterface
     */
    public function getComponentById($id,ContainerInterface $parent = null)
    {
        // first, make sure the path is absolute
        $name = $this->makeNameAbsolute($id,$parent);

        // return the value if it exists
        return array_key_exists($name,$this->componentsByName) ? $this->componentsByName[$name] : null;
    }

    /**
     * @param $name
     * @return bool
     */
    protected function isAbsolute($name)
    {
        return strpos($name,'/') === 0;
    }

    /**
     * @param $name
     * @param ContainerInterface $parent
     * @return string
     */
    protected function makeNameAbsolute($name,ContainerInterface $parent = null)
    {
        // if it already is absolute, or no parent provided
        if($this->isAbsolute($name) || is_null($parent))
        {
            return trim($name,'/');
        }

        return trim($parent->getDataPath().'/'.$name,'/');
    }

    /**
     * @param $id
     * @param ContainerInterface $parent
     * @return string
     */
    protected function makeIdAbsolute($id,ContainerInterface $parent = null)
    {
        // if it already is absolute, or no parent provided
        if($this->isAbsolute($id) || is_null($parent))
        {
            return trim($id,'/');
        }

        return trim($parent->getFullId().'/'.$id,'/');
    }

    /**
     * @param ComponentInterface $component
     */
    public function registerComponent(ComponentInterface $component)
    {
        $this->componentsById[$component->getFullId()] = $component;

        // register value if it is a data unit
        if($component instanceof DataUnitComponentInterface)
        {
            if(!$component->shouldIgnoreValue())
            {
                $this->values[$component->getFullName()] = $component->getValue();
            }

            $this->componentsByName[$component->getFullName()] = $component;
        }
    }

    /**
     * @return bool
     */
    public function hasSubmit()
    {
        return $this->form->hasSubmit();
    }

    /**
     * @param $name
     * @return bool
     */
    public function hasInput($name)
    {
        if($this->form->getHttpMethod() === 'get')
        {
            return $this->services->getRequestHandler()->hasGet($name);
        }
        else
        {
            return $this->services->getRequestHandler()->hasPost($name);
        }
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getInput($name)
    {
        if($this->form->getHttpMethod() === 'get')
        {
            return $this->services->getRequestHandler()->get($name);
        }
        else
        {
            return $this->services->getRequestHandler()->post($name);
        }
    }

    /**
     * @return ServiceProviderInterface
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * @return string
     */
    public function getFormId()
    {
        return $this->form->getId();
    }

    /**
     * @return bool
     */
    public function isPersistent()
    {
        return $this->form->isPersistent();
    }
}