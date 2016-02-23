<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 23-2-2016
 * Time: 17:03
 */

namespace Zingular\Forms\Component;

/**
 * Class HtmlAttributesTrait
 * @package Zingular\Forms\Component
 */
trait HtmlAttributesTrait
{
    /**
     * @var array
     */
    protected $htmlAttributes = array();

    /**
     * @param $attribute
     * @param $value
     * @return $this
     */
    public function setHtmlAttribute($attribute,$value)
    {
        $this->htmlAttributes[$attribute] = (string) $value;
        return $this;
    }

    /**
     * @param $attribute
     * @return bool
     */
    public function hasHtmlAttribute($attribute)
    {
        return array_key_exists($attribute,$this->htmlAttributes);
    }

    /**
     * @param $attribute
     * @return string
     */
    public function getHtmlAttribute($attribute)
    {
        return $this->hasHtmlAttribute($attribute) ? $this->htmlAttributes[$attribute] : null;
    }

    /**
     * @param $attribute
     * @return $this
     */
    public function unsetHtmlAttribute($attribute)
    {
        unset($this->htmlAttributes[$attribute]);
        return $this;
    }

    /**
     * @return string
     */
    public function getHtmlAttributesAsString()
    {
        return implode(' ',array_map(function($k,$v){return $k.'="'.$v.'"';},array_keys($this->htmlAttributes),array_values($this->htmlAttributes)));
    }
}