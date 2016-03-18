<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 8-3-2016
 * Time: 19:21
 */

namespace Zingular\Forms\Service\Bridge\Translation;
use Zingular\Forms\Component\ComponentInterface;
use Zingular\Forms\Component\DataUnitComponentInterface;
use Zingular\Forms\Component\FormState;
use Zingular\Forms\Component\TypedComponentInterface;

/**
 * Class TranslationHandler
 * @package Zingular\Forms\Service\Bridge\Translation
 */
class TranslationHandler implements TranslatorInterface
{
    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * @param TranslatorInterface $translator
     */
    public function setTranslator(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @param $key
     * @param array $params
     * @return string|null
     */
    public function translate($key, array $params = array())
    {
        // if there is no translator, simplt return the key
        if(is_null($this->translator))
        {
            return $key;
        }

        // try to translate
        $translation = $this->translator->translate($key,$params);

        // make sure to always return the key if no translation could be found
        return is_null($translation) ? $key : $translation;
    }

    /**
     * @param $key
     * @param ComponentInterface $component
     * @param FormState $state
     * @return string
     */
    public function parseTranslationKey($key,ComponentInterface $component,FormState $state)
    {
        // TODO: make more effictient by actively looking for tags present in the format, and replacing only those

        // TODO: make sure no errors occur when parent is NULL, etc

        // apply path formatting
        $key = str_replace('{id}',$component->getId(),$key);
        $key = str_replace('{path}',str_replace('/','.',$this->processPath($component->getFullId())),$key);
        $key = str_replace('{parentId}',$component->getParent()->getId(),$key);
        $key = str_replace('{parentPath}',$this->processPath($component->getParent()->getFullId()),$key);
        $key = str_replace('{parentName}',$this->processPath($component->getParent()->getDataPath()),$key);
        $key = str_replace('{formId}',$this->processPath($state->getFormId()),$key);


        if($component instanceof DataUnitComponentInterface)
        {
            $key = str_replace('{name}',$component->getName(),$key);

        }

        if($component instanceof TypedComponentInterface)
        {
            $key = str_replace('{type}',$component->getType(),$key);
            $key = str_replace('{basetype}',$component->getBaseType(),$key);
        }



        // TODO: make more intelligent (replace any arbitrary set of dots with a single dot, trim dots, etc
        $key = trim(str_replace('..','.',$key),'.');

        return $key;
    }

    // TODO: allow construction to add custom wildcards to the translation key format
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
}