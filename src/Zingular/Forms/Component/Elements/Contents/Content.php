<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 2-2-2016
 * Time: 19:06
 */

namespace Zingular\Forms\Component\Elements\Contents;
use Zingular\Forms\Component\DescribableInterface;
use Zingular\Forms\Component\Elements\AbstractElement;
use Zingular\Forms\Component\FormState;
use Zingular\Forms\Component\CssComponentInterface;
use Zingular\Forms\Events\ComponentEvent;

use Zingular\Forms\Exception\InvalidStateException;

/**
 * Class Content
 * @package Zingular\Form
 */
class Content extends AbstractElement implements
    CssComponentInterface,
    ContentInterface,
    DescribableInterface
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
     * @return string
     * @throws \Exception
     */
    public function getContent()
    {
        if(!is_null($this->content))
        {
            return $this->content;
        }
        elseif(!is_null($this->callback))
        {
            return call_user_func($this->callback,$this->state,$this);
        }
        elseif(!is_null($this->translationKey))
        {
            if(is_null($this->state))
            {
                throw new InvalidStateException
                (
                    sprintf(
                        "Cannot get content from translation key for content component '%' before it is compiled!",$this->getFullId()),'notCompiled');
            }

            return $this->getTranslator()->translateRaw($this->translationKey,$this,$this->state,$this->translationParams);
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
     * @return string
     */
    public function compile(FormState $state)
    {
        // store the state locally
        $this->state = $state;

        // dispatchEvent event
        $event = new ComponentEvent(ComponentEvent::COMPILED,$this);
        $this->dispatchEvent($event);
    }
}