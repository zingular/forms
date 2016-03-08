<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 28-1-2016
 * Time: 19:58
 */

namespace Zingular\Forms\Service\Bridge\Translation;

/**
 * Class DummyTranslator
 * @package Zingular\Forms\Service\Bridge\Translation
 */
class DummyTranslator implements TranslatorInterface
{
    /**
     * @param $key
     * @param array $params
     * @return string|null
     */
    public function translate($key,array $params = array())
    {
        return $key;
    }
}