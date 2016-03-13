<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 20:23
 */

namespace Zingular\Forms\Component;

/**
 * Interface DataUnitComponentInterface
 * @package Zingular\Form\Component
 */
interface DataUnitComponentInterface extends DataComponentInterface
{
    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @return bool
     */
    public function hasValue();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getFullName();

    /**
     * @return bool
     */
    public function hasFixedValue();

    /**
     * @return bool
     */
    public function shouldIgnoreValue();

    /**
     * @return bool
     */
    public function isPersistent();
}