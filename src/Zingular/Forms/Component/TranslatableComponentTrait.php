<?php
/**
 * Created by PhpStorm.
 * User: michielleideman
 * Date: 18-03-16
 * Time: 14:07
 */

namespace Zingular\Forms\Component;

/**
 * Class TranslatableComponentTrait
 * @package Zingular\Forms\Component
 */
trait TranslatableComponentTrait
{
    /**
     * @var string
     */
    protected $translationKey = '{parent}.{id}';

    /**
     * @param string $key
     * @return $this
     */
    public function setTranslationKey($key)
    {
        $this->translationKey = $key;
        return $this;
    }

    /**
     * @return string
     */
    public function getTranslationKey()
    {
        return $this->translationKey.'.'.$this->getId();
    }

    /**
     * @param $format
     * @return string
     */
    protected function replaceWildcards($format)
    {
        // TODO: make more effictient by actively looking for tags present in the format, and replacing only those

        // apply path formatting
        $format = str_replace('{parent}',$this->getParent()->getId(),$format);
        $format = str_replace('{id}',$this->getId(),$format);
        $format = str_replace('{path}',str_replace('/','.',$this->getFullId()),$format);
        $format = str_replace('{parentPath}',str_replace('/','.',$this->getParent()->getFullId()),$format);

        if($this instanceof TypedComponentInterface)
        {
            $format = str_replace('{type}',$this->getType(),$format);
            $format = str_replace('{basetype}',$this->getBaseType(),$format);
        }

        return $format;
    }

}