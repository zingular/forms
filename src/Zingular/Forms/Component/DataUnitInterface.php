<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 20:23
 */

namespace Zingular\Forms\Component;

/**
 * Interface DataUnitInterface
 * @package Zingular\Form\Component
 */
interface DataUnitInterface extends DataInterface
{
    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @param mixed $value
     * @return $this
     */
    public function setValue($value);

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
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * @return bool
     */
    public function hasFixedValue();

    /**
     * @param bool $set
     * @return $this
     */
    public function fixedValue($set = true);

    /**
     * @param bool $set
     * @return $this
     */
    public function ignoreValue($set = true);

    /**
     * @return bool
     */
    public function shouldIgnoreValue();

    /**
     * @param bool $set
     * @return $this
     */
    public function ignoreWhenEmpty($set = true);

    /**
     * @param bool $set
     * @return $this
     */
    public function emptyStringIsValue($set = true);

    /**
     * @param bool $set
     * @return $this
     */
    public function persistent($set = true);

}