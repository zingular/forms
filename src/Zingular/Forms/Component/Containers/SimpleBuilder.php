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
use Zingular\Forms\Exception\InvalidStateException;

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
     * @param string $name
     * @return Input
     */
    public function addInput($name)
    {
        return $this->getCurrentField()->addInput($name);
    }

    /**
     * @param string $name
     * @return Field
     */
    public function nextField($name)
    {
        $this->currentField = $this->getCurrentFieldset()->addField($name);
        return $this->currentField;
    }

    /**
     * @param string $name
     * @param $firstFieldName
     * @return Fieldset
     */
    public function nextFieldset($name,$firstFieldName)
    {
        $this->currentFieldset = $this->buildable->addFieldset($name);
        $this->nextField($firstFieldName);
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
            throw new InvalidStateException("No current fieldset available! Create a new fieldset using nextFieldset method!");
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
            throw new InvalidStateException("No current field available! Create a new field using nextField method!");
        }

        return $this->currentField;
    }
}