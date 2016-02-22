<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 28-1-2016
 * Time: 19:57
 */

namespace Zingular\Forms\Service\Bridge\Request;

/**
 * Class DefaultRequestHandler
 * @package Zingular\Form\Service\Request
 */
class DefaultRequestHandler implements RequestHandlerInterface
{
    /**
     * @param string $name
     * @return bool
     */
    public function hasGet($name)
    {
        return isset($_GET[$name]);
    }

    /**
     * @param string $name
     * @return string
     */
    public function get($name)
    {
        return array_key_exists($name,$_GET) ? $_GET[$name] : null;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasPost($name)
    {
        return isset($_POST[$name]);
    }

    /**
     * @param string $name
     * @return string
     */
    public function post($name)
    {
        return array_key_exists($name,$_POST) ? $_POST[$name] : null;
    }
}