<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 2-2-2016
 * Time: 19:06
 */

namespace Zingular\Forms\Component\Elements\Contents;
use Zingular\Forms\Compilers\ContentCompiler;
use Zingular\Forms\Component\DescribableInterface;
use Zingular\Forms\Component\Elements\AbstractElement;
use Zingular\Forms\Component\FormState;
use Zingular\Forms\Component\CssComponentInterface;
use Zingular\Forms\Events\ComponentEvent;
use Zingular\Forms\Exception\ComponentException;

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
     * @var ContentCompiler
     */
    protected $compiler;

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
     * @return string
     */
    public function getTranslationKey()
    {
        return $this->translationKey;
    }

    /**
     * @return array
     */
    public function getTranslationParams()
    {
        return $this->translationParams;
    }

    /**
     * @return string
     */
    public function getFixedContent()
    {
        return $this->content;
    }

    /**
     * @return callable
     */
    public function getContentCallback()
    {
        return $this->callback;
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
        if(is_null($this->compiler))
        {
            throw new ComponentException($this,sprintf("Cannot retrieve content for component '%s': not compiled yet!",$this->getFullId()));
        }

        return $this->compiler->getContent();
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
        $this->compiler = new ContentCompiler($this,$state);


        //$this->compiler->compile();

        // store the state locally
        $this->state = $state;

        // dispatchEvent event
        $event = new ComponentEvent(ComponentEvent::COMPILED,$this);
        $this->dispatchEvent($event);
    }
}