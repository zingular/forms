<?php
/**
 * Created by PhpStorm.
 * User: michielleideman
 * Date: 18-03-16
 * Time: 10:36
 */

namespace Zingular\Forms\Component\Containers;
use Zingular\Forms\Component\Elements\Controls\Input;

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


    public function addSubmit()
    {
        return $this->buildable->addButton('submit')->ignoreValue();
    }

    /**
     * @return Fieldset
     */
    protected function getCurrentFieldset()
    {
        if(is_null($this->currentFieldset))
        {
            $this->currentFieldset = $this->buildable->addFieldset(uniqid());
        }

        return $this->currentFieldset;
    }

    /**
     * @return Field
     */
    protected function getCurrentField()
    {
        if(is_null($this->currentField))
        {
            $this->currentField = $this->getCurrentFieldset()->addField(uniqid());
        }

        return $this->currentField;
    }
}