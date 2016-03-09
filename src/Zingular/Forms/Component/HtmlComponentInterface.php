<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 9-3-2016
 * Time: 21:04
 */

namespace Zingular\Forms\Component;

/**
 * Interface HtmlComponentInterface
 * @package Zingular\Forms\Component
 */
interface HtmlComponentInterface extends ComponentInterface
{
    /**
     * @param $class
     * @return $this
     */
    public function setCssTypeClass($class);

    /**
     * @param $class
     * @return $this
     */
    public function addCssClass($class);
}