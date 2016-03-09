<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 9-3-2016
 * Time: 21:53
 */

namespace Zingular\Forms\Component;


/**
 * Interface ViewableComponentInterface
 * @package Zingular\Forms\Component
 */
interface ViewableComponentInterface extends ComponentInterface
{
    /**
     * @return mixed
     */
    public function getViewName();
}