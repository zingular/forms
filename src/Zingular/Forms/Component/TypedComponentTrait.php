<?php
/**
 * Created by PhpStorm.
 * User: michielleideman
 * Date: 18-03-16
 * Time: 14:37
 */

namespace Zingular\Forms\Component;

/**
 * Class TypedComponentTrait
 * @package Zingular\Forms\Component
 */
trait TypedComponentTrait
{
    /**
     * @var string
     */
    protected $componentBaseType = '';

    /**
     * @var string
     */
    protected $componentType = '';

    /**
     * @param $baseType
     * @return $this
     */
    public function setComponentBaseType($baseType)
    {
        $this->componentBaseType = $baseType;
        return $this;
    }

    /**
     * @param $type
     * @return $this
     */
    public function setComponentType($type)
    {
        $this->componentType = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getComponentBaseType()
    {
        return $this->componentBaseType;
    }

    /**
     * @return string
     */
    public function getComponentType()
    {
        return $this->componentType;
    }
}