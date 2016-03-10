<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 31-1-2016
 * Time: 20:17
 */

namespace Zingular\Forms\Component;

use Zingular\Forms\Component\Container\Container;
use Zingular\Forms\Component\Container\Form;


/**
 * Class State
 * @package Zingular\Form
 */
class State
{
    /**
     * @var Form
     */
    protected $form;

    /**
     * @var ServicesInterface
     */
    protected $services;

    /**
     * @var array
     */
    protected $values = array();

    /**
     * @param Form $form
     * @param ServicesInterface $services
     */
    public function __construct(Form $form,ServicesInterface $services)
    {
        $this->form = $form;
        $this->services = $services;
    }

    /**
     * @param $componentName
     * @param Container $parent
     * @return mixed
     */
    public function getValue($componentName,Container $parent = null)
    {
        return $this->hasValue($componentName,$parent) ? $this->values[$componentName] : null;
    }

    /**
     * @param bool|true $primaryOnly
     * @return array
     */
    public function getValues($primaryOnly = true)
    {
        // TODO: only primary
        return $this->values;
    }

    /**
     * @param $componentName
     * @param Container $parent
     * @return bool
     */
    public function hasValue($componentName,Container $parent = null)
    {
        return isset($this->values[$componentName]);
    }

    /**
     * @param DataUnitInterface $component
     */
    public function registerValue(DataUnitInterface $component)
    {
        $this->values[$component->getFullName()] = $component->getValue();
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
        if($this->form->getMethod() === 'get')
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
        if($this->form->getMethod() === 'get')
        {
            return $this->services->getRequestHandler()->get($name);
        }
        else
        {
            return $this->services->getRequestHandler()->post($name);
        }
    }

    /**
     * @return ServiceGetterInterface
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