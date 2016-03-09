<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 16:53
 */

namespace Zingular\Forms\Service\Bridge\Js;


/**
 * Interface JsHandlerInterface
 * @package Zingular\Forms\Service\Bridge\Js
 */
interface JsHandlerInterface
{
    /**
     * @param $script
     */
    public function requireScript($script);
}