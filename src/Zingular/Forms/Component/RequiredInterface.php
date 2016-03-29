<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 9-3-2016
 * Time: 21:15
 */

namespace Zingular\Forms\Component;

/**
 * Interface RequiredInterface
 * @package Zingular\Forms\Component
 */
interface RequiredInterface extends DataUnitComponentInterface
{
    /**
     * @param bool $required
     * @return $this
     */
    public function setRequired($required = true);

    /**
     * @return bool
     */
    public function isRequired();
}