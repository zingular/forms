<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 18-3-2016
 * Time: 21:16
 */

namespace Zingular\Forms\Service\Bridge\Translation;

use Zingular\Forms\Component\ComponentInterface;
use Zingular\Forms\Component\FormState;

/**
 * Interface TranslationKeyWildcardInterface
 * @package Zingular\Forms\Service\Bridge\Translation
 */
interface TranslationKeyWildcardInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param ComponentInterface $component
     * @param FormState $state
     * @return mixed
     */
    public function replace(ComponentInterface $component,FormState $state);
}