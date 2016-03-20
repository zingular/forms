<?php
/**
 * Created by PhpStorm.
 * User: michielleideman
 * Date: 18-03-16
 * Time: 14:34
 */

namespace Zingular\Forms\Component;

/**
 * Interface TypedComponentInterface
 * @package Zingular\Forms\Component\Containers
 */
interface TypedComponentInterface
{
    /**
     * @param $baseType
     * @return $this
     */
    public function setComponentBaseType($baseType);

    /**
     * @param $type
     * @return $this
     */
    public function setComponentType($type);

    /**
     * @return string
     */
    public function getComponentBaseType();

    /**
     * @return string
     */
    public function getComponentType();
}