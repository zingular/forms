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
    public function setBaseType($baseType);

    /**
     * @param $type
     * @return $this
     */
    public function setType($type);

    /**
     * @return string
     */
    public function getBaseType();

    /**
     * @return string
     */
    public function getType();
}