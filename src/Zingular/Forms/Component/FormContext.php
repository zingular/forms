<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 31-1-2016
 * Time: 20:17
 */

namespace Zingular\Forms\Component;

use Zingular\Forms\Component\Container\Form;
use Zingular\Forms\Service\Services;

/**
 * Class FormContext
 * @package Zingular\Form
 */
class FormContext
{
    /**
     * @var Form
     */
    protected $form;

    /**
     * @var Services
     */
    protected $services;

    /**
     * @var array
     */
    protected $values = array();

    /**
     * @param Form $form
     * @param Services $services
     */
    public function __construct(Form $form,Services $services)
    {
        $this->form = $form;
        $this->services = $services;
    }

    /**
     * @param $componentName
     * @return mixed
     */
    public function getValue($componentName)
    {
        return $this->hasValue($componentName) ? $this->values[$componentName] : null;
    }

    /**
     * @param $componentName
     * @return bool
     */
    public function hasValue($componentName)
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
     * @return Services
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