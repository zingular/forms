<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 9-2-2016
 * Time: 21:59
 */

namespace Zingular\Forms\Service\Bridge\Translation;

/**
 * Class ArrayTranslator
 * @package Zingular\Form\Service\Bridge\Translation
 */
class ArrayTranslator extends AbstractTranslator
{
    /**
     * @var array
     */
    protected $translations;

    /**
     * @param array $translations
     */
    public function __construct(array $translations = array())
    {
        $this->translations = $translations;
    }

    /**
     * @param $key
     * @param $translation
     */
    public function setTranslation($key,$translation)
    {
        $this->translations[$key] = $translation;
    }

    /**
     * @param array $translations
     */
    public function setTranslations(array $translations = array())
    {
        $this->translations = $translations;
    }

    /**
     * @param $key
     * @param array $params
     * @return string
     */
    public function translate($key,array $params = array())
    {
        return isset($this->translations[$key]) ? $this->replaceWildcards($this->translations[$key],$params) : $key;
    }

    /**
     * @param $key
     * @return string
     */
    protected function tagify($key)
    {
        return '{'.$key.'}';
    }
}