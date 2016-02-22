<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 17-2-2016
 * Time: 19:26
 */

namespace Zingular\Forms\Service\Bridge\Translation;

/**
 * Class AbstractTranslator
 * @package Zingular\Form\Service\Bridge\Translation
 */
abstract class AbstractTranslator implements TranslatorInterface
{
    /**
     * @param $translation
     * @param array $params
     * @return string
     */
    protected function replaceWildcards($translation,array $params = array())
    {
        foreach($params as $key=>$value)
        {
            if(!is_scalar($value))
            {
                continue;
            }

            $translation = str_replace($this->tagify($key),(string) $value,$translation);
        }

        return $translation;
    }

    abstract protected function tagify($key);
}