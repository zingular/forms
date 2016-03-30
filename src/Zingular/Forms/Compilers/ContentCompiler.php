<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 21-3-2016
 * Time: 21:18
 */

namespace Zingular\Forms\Compilers;


use Zingular\Forms\Component\Elements\Contents\Content;
use Zingular\Forms\Component\Elements\Contents\ContentInterface;
use Zingular\Forms\Component\FormState;
use Zingular\Forms\Exception\InvalidStateException;

/**
 * Class ContentCompiler
 * @package Zingular\Forms\Compilers
 */
class ContentCompiler
{
    /**
     * @param Content $component
     * @param FormState $state
     * @return mixed|string
     */
    public function compile(Content $component,FormState $state) // TODO: typehint to interface
    {
        if(!is_null($component->getContentCallback()))
        {
            $component->setContent(call_user_func($component->getContentCallback(),$state,$this));
        }
        elseif(!is_null($component->getTranslationKey()))
        {
            $component->setContent($state->getServices()->getTranslator()->translateRaw($component->getTranslationKey(),$component,$state,$component->getTranslationParams()));
        }
    }
}