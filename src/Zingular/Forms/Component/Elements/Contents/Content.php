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

use Zingular\Forms\Component\CssComponentInterface;


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
        return $this->content;
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
}