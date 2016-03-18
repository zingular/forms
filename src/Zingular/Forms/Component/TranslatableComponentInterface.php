<?php
/**
 * Created by PhpStorm.
 * User: michielleideman
 * Date: 18-03-16
 * Time: 14:00
 */

namespace Zingular\Forms\Component;

/**
 * Interface TranslatableComponentInterface
 * @package Zingular\Forms\Component
 */
interface TranslatableComponentInterface extends ComponentInterface
{
    /**
     * @param string $key
     * @return $this
     */
    public function setTranslationKey($key);

    /**
     * @return string
     */
    public function getTranslationKey();


}