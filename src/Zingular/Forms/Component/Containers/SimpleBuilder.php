<?php
/**
 * Created by PhpStorm.
 * User: michielleideman
 * Date: 18-03-16
 * Time: 10:36
 */

namespace Zingular\Forms\Component\Containers;
use Zingular\Forms\Component\Elements\Controls\Input;
use Zingular\Forms\Exception\FormException;

/**
 * Class SimpleBuilder
 * @package Zingular\Forms\Component\Containers
 */
class SimpleBuilder
{
    /**
     * @var BuildableInterface
     */
    protected $buildable;

    /**
     * @var Fieldset
     */
    protected $currentFieldset;

    /**
     * @var Field
     */
    protected $currentField;

    /**
     * SimpleBuilder constructor.
     * @param BuildableInterface $buildable
     */
    public function __construct(BuildableInterface $buildable)
    {
        $this->buildable = $buildable;
    }

    /**
     * @param $name
     * @return Input
     */
    public function addInput($name)
    {
        return $this->getCurrentField()->addInput($name);
    }

    /**
     * @param $name
     * @return Field
     */
    public function nextField($name)
    {
        $this->currentField = $this->getCurrentFieldset()->addField($name);
        return $this->currentField;
    }

    /**
     * @param $name
     * @param $fieldName
     * @return Fieldset
     */
    public function nextFieldset($name,$fieldName)
    {
        $this->currentFieldset = $this->buildable->addFieldset($name);
        $this->nextField($fieldName);
        return $this->currentFieldset;
    }

    /**
     * @return $this
     */
    public function addSubmit()
    {
        return $this->buildable->addButton('submit')->ignoreValue();
    }

    /**
     * @return Fieldset
     * @throws FormException
     */
    protected function getCurrentFieldset()
    {
        if(is_null($this->currentFieldset))
        {
            throw new FormException("No current fieldset available! Create a new fieldset using nextFieldset method!");
        }

        return $this->currentFieldset;
    }

    /**
     * @return Field
     * @throws FormException
     */
    protected function getCurrentField()
    {
        if(is_null($this->currentField))
        {
            throw new FormException("No current field available! Create a new field using nextField method!");
        }

        return $this->currentField;
    }
}