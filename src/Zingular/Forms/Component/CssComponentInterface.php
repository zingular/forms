<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 9-3-2016
 * Time: 21:04
 */

namespace Zingular\Forms\Component;

/**
 * Interface CssComponentInterface
 * @package Zingular\Forms\Component
 */
interface CssComponentInterface extends ComponentInterface
{
    /**
     * @param $class
     * @return $this
     */
    public function setCssBaseTypeClass($class);

    /**
     * @return string
     */
    public function getCssBaseTypeClass();

    /**
     * @param $class
     * @return $this
     */
    public function setCssTypeClass($class);

    /**
     * @return string
     */
    public function getCssTypeClass();

    /**
     * @param $class
     * @return $this
     */
    public function addCssClass($class);

    /**
     * @return string
     */
    public function getCssClass();
}