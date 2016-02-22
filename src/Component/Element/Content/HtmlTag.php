<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 2-2-2016
 * Time: 20:42
 */

namespace Zingular\Form\Component\Element\Content;
use Zingular\Form\BaseTypes;

/**
 * Class HtmlTag
 * @package Zingular\Form
 */
class HtmlTag extends Content
{
    /**
     * @var string
     */
    protected $baseType = BaseTypes::HTMLTAG;

    /**
     * @var array
     */
    protected $attribues = array();

    /**
     * @var string
     */
    protected $tagName = 'div';

    /**
     * @param string $tag
     * @return $this
     */
    public function setTagName($tag)
    {
        $this->tagName = $tag;
        return $this;
    }

    /**
     * @return string
     */
    public function getTagName()
    {
        return $this->tagName;
    }

    /**
     * @param array $attributes
     */
    public function setAttributes(array $attributes = array())
    {
        $this->attribues = $attributes;
    }

    /**
     * @param $attribute
     * @param $value
     */
    public function setAttribute($attribute,$value = null)
    {
        if(strlen($value))
        {
            $this->attribues[$attribute] = $value;
        }
    }
}