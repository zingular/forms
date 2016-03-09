<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 9-3-2016
 * Time: 21:31
 */

namespace Zingular\Forms\Component;

/**
 * Class ViewSetterTrait
 * @package Zingular\Forms\Component
 */
trait ViewSetterTrait
{

    /**
     * @var string
     */
    protected $viewName;


    /**
     * @return string
     */
    public function getViewName()
    {
        return $this->viewName;
    }

    /**
     * @param $name
     * @return $this
     */
    public function setViewName($name)
    {
        $this->viewName = $name;
        return $this;
    }
}