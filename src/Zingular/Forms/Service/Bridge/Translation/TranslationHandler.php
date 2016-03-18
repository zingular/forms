<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 8-3-2016
 * Time: 19:21
 */

namespace Zingular\Forms\Service\Bridge\Translation;
use Zingular\Forms\Component\ComponentInterface;
use Zingular\Forms\Component\FormState;

/**
 * Class TranslationHandler
 * @package Zingular\Forms\Service\Bridge\Translation
 */
class TranslationHandler implements TranslatorInterface
{
    /**
     * @var WildcardReplacer
     */
    protected $replacer;

    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * @param WildcardReplacer $replacer
     */
    public function __construct(WildcardReplacer $replacer)
    {
        $this->replacer = $replacer;
    }

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
     * @return string
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

        // TODO: nested translations: check returned translation to contain a sub-translation, and while so, keep translating the sub-translation

        // make sure to always return the key if no translation could be found
        return is_null($translation) ? $key : $translation;
    }

    /**
     * @param string $rawKey
     * @param ComponentInterface $component
     * @param FormState $state
     * @param array $params
     * @return string
     */
    public function translateRaw($rawKey,ComponentInterface $component,FormState $state,array $params = array())
    {
        return $this->translate($this->replacer->parse($rawKey,$component,$state),$params);
    }
}