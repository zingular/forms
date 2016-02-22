<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 28-1-2016
 * Time: 19:39
 */

namespace Zingular\Forms\Service\Bridge\Request;

/**
 * Interface RequestHandlerInterface
 * @package Zingular\Form\Service\Request
 */
interface RequestHandlerInterface
{
    /**
     * @param $name
     * @return bool
     */
    public function hasGet($name);

    /**
     * @param $name
     * @return mixed
     */
    public function get($name);

    /**
     * @param $name
     * @return bool
     */
    public function hasPost($name);

    /**
     * @param $name
     * @return mixed
     */
    public function post($name);
}