<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 9-3-2016
 * Time: 21:34
 */

namespace Zingular\Forms\Component;

/**
 * Class CssComponentTrait
 * @package Zingular\Forms\Component
 */
trait CssComponentTrait
{
    /**
     * @var string
     */
    protected $cssBaseTypeClass = '';

    /**
     * @var string
     */
    protected $cssTypeClass = '';

    /**
     * @var string
     */
    protected $cssClasses = array();

    /**
     * @param $class
     * @return $this
     */
    public function setCssTypeClass($class)
    {
        $this->cssTypeClass = $class;
        return $this;
    }

    /**
     * @return string
     */
    public function getCssTypeClass()
    {
        return $this->cssTypeClass;
    }

    /**
     * @param $class
     * @return $this
     */
    public function setCssBaseTypeClass($class)
    {
        $this->cssBaseTypeClass = $class;
        return $this;
    }

    /**
     * @return string
     */
    public function getCssBaseTypeClass()
    {
        return $this->cssBaseTypeClass;
    }

    /**
     * @param $class
     * @return $this
     */
    public function addCssClass($class)
    {
        $class = trim($class);

        if(strlen($class))
        {
            $this->cssClasses[trim($class)] = true;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getCssClass()
    {
        $classes = array();

        if(!is_null($this->cssBaseTypeClass))
        {
            $classes[] = $this->cssBaseTypeClass;
        }
        if(!is_null($this->cssTypeClass))
        {
            $classes[] = $this->cssTypeClass;
        }

        $classes = array_merge($classes,array_keys($this->cssClasses),$this->getRuntimeClasses());
        array_walk($classes,'trim');
        $classes = array_filter($classes,'strlen');
        return implode(' ',$classes);
    }

    /**
     * @return array
     */
    protected function getRuntimeClasses()
    {
        return array();
    }
}