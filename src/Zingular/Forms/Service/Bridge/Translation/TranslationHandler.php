<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 8-3-2016
 * Time: 19:21
 */

namespace Zingular\Forms\Service\Bridge\Translation;

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
}