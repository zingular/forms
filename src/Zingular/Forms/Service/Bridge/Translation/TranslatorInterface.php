<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 28-1-2016
 * Time: 19:40
 */

namespace Zingular\Forms\Service\Bridge\Translation;

/**
 * Interface TranslatorInterface
 * @package Zingular\Form\Service\Bridge\Translation
 */
interface TranslatorInterface
{
    /**
     * @param $key
     * @param array $params
     * @return string|null
     */
    public function translate($key,array $params = array());
}