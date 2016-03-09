<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 9-3-2016
 * Time: 21:12
 */

namespace Zingular\Forms\Component;

/**
 * Interface HtmlAttributesInterface
 * @package Zingular\Forms\Component
 */
interface HtmlAttributesInterface
{
    /**
     * @param $attribute
     * @param $value
     * @return $this
     */
    public function setHtmlAttribute($attribute,$value);

    /**
     * @param $attribute
     * @return bool
     */
    public function hasHtmlAttribute($attribute);

    /**
     * @param $attribute
     * @return string
     */
    public function getHtmlAttribute($attribute);

    /**
     * @param $attribute
     * @return $this
     */
    public function unsetHtmlAttribute($attribute);

    /**
     * @return string
     */
    public function getHtmlAttributesAsString();
}