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
    protected $baseType = '';

    /**
     * @var string
     */
    protected $type = '';

    /**
     * @param $baseType
     * @return $this
     */
    public function setBaseType($baseType)
    {
        $this->baseType = $baseType;
        return $this;
    }

    /**
     * @param $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getBaseType()
    {
        return $this->baseType;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}