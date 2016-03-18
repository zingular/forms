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
        return $this->parseTranslationKey($this->translationKey);
    }




    /**
     * @param $key
     * @return string
     */
    protected function parseTranslationKey($key)
    {
        // TODO: make more effictient by actively looking for tags present in the format, and replacing only those

        // apply path formatting
        $key = str_replace('{id}',$this->getId(),$key);
        $key = str_replace('{path}',str_replace('/','.',$this->processPath($this->getFullId())),$key);
        $key = str_replace('{parentId}',$this->getParent()->getId(),$key);
        $key = str_replace('{parentPath}',$this->processPath($this->getParent()->getFullId()),$key);

        if($this instanceof DataUnitComponentInterface)
        {
            $key = str_replace('{name}',$this->getName(),$key);
            $key = str_replace('{parentName}',$this->processPath($this->getParent()->getDataPath()),$key);
        }

        if($this instanceof TypedComponentInterface)
        {
            $key = str_replace('{type}',$this->getType(),$key);
            $key = str_replace('{basetype}',$this->getBaseType(),$key);
        }

        return $key;
    }

    /**
     * @param $path
     * @return mixed
     */
    protected function processPath($path)
    {
        return str_replace('/','.',$path);
    }



    // TODO: add option to apply translation, with replacing wildcards, and optionally recursive replace (also replace references to other component names)
    // "Field '{control.myControl.name}' is required!" special wildcard 'control' (with any sub-keys) will get recursively translated
}