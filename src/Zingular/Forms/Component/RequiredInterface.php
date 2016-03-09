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
interface RequiredInterface
{
    /**
     * @param bool $required
     * @param null $translationKey
     * @return $this
     */
    public function setRequired($required = true,$translationKey = null);

    /**
     * @return bool
     */
    public function isRequired();
}