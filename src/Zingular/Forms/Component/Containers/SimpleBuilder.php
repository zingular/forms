<?php
/**
 * Created by PhpStorm.
 * User: michielleideman
 * Date: 18-03-16
 * Time: 10:36
 */

namespace Zingular\Forms\Component\Containers;
use Zingular\Forms\ButtonType;
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
     * @var Container
     */
    protected $currentFieldset;

    /**
     * @var Container
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
     * @return Container
     */
    public function startField($name)
    {
        $this->currentField = $this->getCurrentFieldset()->addField($name);
        return $this->currentField;
    }

    /**
     * @param string $name
     * @return Container
     */
    public function startFieldset($name)
    {
        $this->currentFieldset = $this->buildable->addFieldset($name);
        return $this->currentFieldset;
    }

    /**
     * @return $this
     */
    public function addSubmit()
    {
        return $this->buildable
            ->addButton('submit')
            ->ignoreValue()
            ->setType(ButtonType::SUBMIT);
    }

    /**
     * @return Container
     * @throws FormException
     */
    protected function getCurrentFieldset()
    {
        if(is_null($this->currentFieldset))
        {
            throw new InvalidStateException("No current fieldset available! Create a new fieldset using startFieldset method!");
        }

        return $this->currentFieldset;
    }

    /**
     * @return Container
     * @throws FormException
     */
    protected function getCurrentField()
    {
        if(is_null($this->currentField))
        {
            throw new InvalidStateException("No current field available! Create a new field using startField method!");
        }

        return $this->currentField;
    }
}