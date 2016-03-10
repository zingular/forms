<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 2-2-2016
 * Time: 19:06
 */

namespace Zingular\Forms\Component\Element\Content;
use Zingular\Forms\Component\Element\AbstractElement;
use Zingular\Forms\Component\FormState;
use Zingular\Forms\Component\CssComponentInterface;

/**
 * Class Content
 * @package Zingular\Form
 */
class Content extends AbstractElement implements CssComponentInterface,ContentInterface
{
    /**
     * @var string
     */
    protected $content;

    /**
     * @var string
     */
    protected $translationKey;

    /**
     * @var array
     */
    protected $translationParams;

    /**
     * @var callable
     */
    protected $callback;

    /**
     * @param $key
     * @param array $params
     * @return $this
     */
    public function setTranslationKey($key,array $params = array())
    {
        $this->translationKey = $key;
        $this->translationParams = $params;
        return $this;
    }

    /**
     * @param $content
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @param callable $callable
     */
    public function setContentCallback($callable)
    {
        $this->callback = $callable;
    }

    /**
     * @return mixed|string
     * @throws \Exception
     */
    public function getContent()
    {
        if(!is_null($this->content))
        {
            return $this->content;
        }
        elseif(!is_null($this->translationKey))
        {
            if(is_null($this->state))
            {
                throw new \Exception();
            }
            return $this->state->getServices()->getTranslator()->translate($this->translationKey,$this->translationParams);
        }
        elseif(!is_null($this->callback))
        {
            return call_user_func($this->callback,$this->state,$this);
        }

        return '';
    }

    /**
     *
     */
    public function describe()
    {
        return array
        (
            'name'=>$this->getId(),
            'fullName'=>$this->getFullId(),
            'type'=>get_class($this)
        );
    }

    /**
     * @param FormState $state
     * @param array $defaultValues
     * @return string
     */
    public function compile(FormState $state,array $defaultValues = array())
    {
        $this->state = $state;
    }
}