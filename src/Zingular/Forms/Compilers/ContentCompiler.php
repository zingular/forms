<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 21-3-2016
 * Time: 21:18
 */

namespace Zingular\Forms\Compilers;


use Zingular\Forms\Component\Elements\Contents\Content;
use Zingular\Forms\Component\FormState;
use Zingular\Forms\Exception\InvalidStateException;

/**
 * Class ContentCompiler
 * @package Zingular\Forms\Compilers
 */
class ContentCompiler
{
    /**
     * @var Content
     */
    protected $component;

    /**
     * @var FormState
     */
    protected $state;

    /**
     * @param Content $component
     * @param FormState $state
     */
    public function __construct(Content $component,FormState $state)
    {
        $this->component = $component;
        $this->state = $state;
    }

    /**
     * @return mixed|string
     * @throws InvalidStateException
     */
    public function getContent()
    {
        if(!is_null($this->component->getFixedContent()))
        {
            return $this->component->getFixedContent();
        }
        elseif(!is_null($this->component->getContentCallback()))
        {
            return call_user_func($this->component->getContentCallback(),$this->state,$this);
        }
        elseif(!is_null($this->component->getTranslationKey()))
        {
            return $this->state->getServices()->getTranslator()->translateRaw($this->component->getTranslationKey(),$this->component,$this->state,$this->component->getTranslationParams());
        }

        return '';
    }
}