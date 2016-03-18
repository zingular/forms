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
 * Class TranslationKeyWildcard
 * @package Zingular\Forms\Service\Bridge\Translation
 */
class CallableTranslationKeyWildcard implements TranslationKeyWildcardInterface
{
    /**
     * @var callable
     */
    protected $callback;

    /**
     * @var string
     */
    protected $name;

    /**
     * @param string $name
     * @param callable $callback
     */
    public function __construct($name,$callback)
    {
        $this->name = $name;
        $this->callback = $callback;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param ComponentInterface $component
     * @param FormState $state
     * @return mixed
     */
    public function replace(ComponentInterface $component, FormState $state)
    {
        return call_user_func($this->callback,$component,$state);
    }
}