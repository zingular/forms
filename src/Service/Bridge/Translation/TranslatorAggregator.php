<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 9-2-2016
 * Time: 21:58
 */

namespace Zingular\Form\Service\Bridge\Translation;

/**
 * Class TranslatorAggregator
 * @package Zingular\Form\Service\Bridge\Translation
 */
class TranslatorAggregator implements TranslatorInterface
{
    /**
     * @var array
     */
    protected $translators = array();

    /**
     * @param TranslatorInterface $translator
     */
    public function addTranslator(TranslatorInterface $translator)
    {
        $this->translators[] = $translator;
    }

    /**
     * @param $key
     * @param array $params
     * @return string
     */
    public function translate($key,array $params = array())
    {
        /** @var TranslatorInterface $translator */
        foreach($this->translators as $translator)
        {
            $translation = $translator->translate($key,$params);

            if($translation !== $key)
            {
                return $translation;
            }
        }

        return $key;
    }
}