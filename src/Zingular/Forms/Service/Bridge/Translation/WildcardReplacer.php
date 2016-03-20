<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 18-3-2016
 * Time: 20:42
 */

namespace Zingular\Forms\Service\Bridge\Translation;
use Zingular\Forms\Component\ComponentInterface;
use Zingular\Forms\Component\DataUnitComponentInterface;
use Zingular\Forms\Component\FormState;
use Zingular\Forms\Component\TypedComponentInterface;
use Zingular\Forms\Exception\FormException;

/**
 * Class WildcardReplacer
 * @package Zingular\Forms\Service\Bridge\Translation
 */
class WildcardReplacer
{
    const TYPE = 'type';
    const BASETYPE = 'baseType';
    const ID = 'id';
    const ID_FULL = 'fullId';
    const NAME = 'name';
    const NAME_FULL = 'fullName';
    const PARENT_ID = 'parentId';
    const PARENT_ID_FULL = 'parentFullId';
    const PARENT_NAME = 'parentName';
    const PARENT_NAME_FULL = 'parentFullName';
    const FORM_ID = 'formId';

    /**
     * @var array
     */
    protected $customCallbacks = array();

    /**
     * @param $key
     * @param ComponentInterface $component
     * @param FormState $state
     * @return string
     * @throws FormException
     */
    public function parse($key,ComponentInterface $component,FormState $state)
    {
        $customCallbacks = $this->customCallbacks;

        $callback = function(array $matches) use ($component,$state,$key,$customCallbacks)
        {
            if(!isset($matches[2]))
            {
                return '';
            }

            $wildcard = $matches[2];

            switch($wildcard)
            {
                case self::TYPE: return $this->replaceType($component);
                case self::BASETYPE: return $this->replaceBaseType($component);
                case self::ID: return $component->getId();
                case self::ID_FULL: return $component->getFullId();
                case self::PARENT_ID: return $this->replaceParentId($component);
                case self::PARENT_ID_FULL: return $this->replaceParentFullId($component);
                case self::NAME: return $this->replaceName($component);
                case self::NAME_FULL: return $this->replaceFullName($component);
                case self::PARENT_NAME: return $this->replaceParentName($component);
                case self::PARENT_NAME_FULL: return $this->replaceParentFullName($component);
                case self::FORM_ID: return $state->getFormId();
                default:
                {
                    // try to load a custom wildcard replacement callback
                    if(isset($customCallbacks[$wildcard]))
                    {
                        /** @var TranslationKeyWildcardInterface $wc */
                        $wc = $customCallbacks[$wildcard];

                        return $wc->replace($component,$state);
                    }

                    // if no custom callback, fail
                    throw new FormException(sprintf("Unknown translation key wildcard '%s'",$wildcard),'translation.keyWildcardUnknown',array('wildcard'=>$wildcard,'key'=>$key));
                }
            }
        };

        $key = preg_replace_callback('/({([a-zA-Z0-9]+)})/',$callback,$key);

        if(is_null($key))
        {
            throw new FormException(sprintf("Cannot parse translation key '%s': invalid format!",$key),'translation.keyParseError',array('key'=>$key));
        }

        return trim(str_replace('..','.',$key),'.');
    }

    /**
     * @param TranslationKeyWildcardInterface $wildcard
     */
    public function addWildcard(TranslationKeyWildcardInterface $wildcard)
    {
        $this->customCallbacks[$wildcard->getName()] = $wildcard;
    }

    // TODO: add option to apply translation, with replacing wildcards, and optionally recursive replace (also replace references to other component names)
    // "Field '{control.myControl.name}' is required!" special wildcard 'control' (with any sub-keys) will get recursively translated

    /**
     * @param $path
     * @return mixed
     */
    protected function processPath($path)
    {
        return str_replace('/','.',$path);
    }

    /***********************************************************************
     * REPLACE CALLBACKS
     **********************************************************************/

    /**
     * @param ComponentInterface $component
     * @return string
     */
    protected function replaceType(ComponentInterface $component)
    {
        if($component instanceof TypedComponentInterface)
        {
            return $component->getComponentType();
        }

        return '';
    }

    /**
     * @param ComponentInterface $component
     * @return string
     */
    protected function replaceBaseType(ComponentInterface $component)
    {
        if($component instanceof TypedComponentInterface)
        {
            return $component->getComponentBaseType();
        }

        return '';
    }

    /**
     * @param ComponentInterface $component
     * @return string
     */
    protected function replaceParentId(ComponentInterface $component)
    {
        $parent = $component->getParent();

        if(is_null($parent))
        {
            return '';
        }

        return $parent->getId();
    }

    /**
     * @param ComponentInterface $component
     * @return string
     */
    protected function replaceParentFullId(ComponentInterface $component)
    {
        $parent = $component->getParent();

        if(is_null($parent))
        {
            return '';
        }

        return $this->processPath($parent->getFullId());
    }

    /**
     * @param ComponentInterface $component
     * @return string
     */
    protected function replaceName(ComponentInterface $component)
    {
        if($component instanceof DataUnitComponentInterface)
        {
            return $component->getName();
        }

        return '';
    }

    /**
     * @param ComponentInterface $component
     * @return string
     */
    protected function replaceFullName(ComponentInterface $component)
    {
        if($component instanceof DataUnitComponentInterface)
        {
            return $this->processPath($component->getFullName());
        }

        return '';
    }

    /**
     * @param ComponentInterface $component
     * @return string
     */
    protected function replaceParentName(ComponentInterface $component)
    {
        $parent = $component->getParent();

        if(is_null($parent) )
        {
            return '';
        }
        elseif($parent instanceof DataUnitComponentInterface)
        {
            return $parent->getName();
        }

        return '';
    }

    /**
     * @param ComponentInterface $component
     * @return string
     */
    protected function replaceParentFullName(ComponentInterface $component)
    {
        $parent = $component->getParent();

        if(is_null($parent))
        {
            return '';
        }
        elseif($parent instanceof DataUnitComponentInterface)
        {
            return $this->processPath($parent->getFullName());
        }

        return '';
    }
}