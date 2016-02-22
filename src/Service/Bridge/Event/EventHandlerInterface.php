<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 28-1-2016
 * Time: 20:40
 */

namespace Zingular\Form\Service\Bridge\Event;

/**
 * Interface EventHandlerInterface
 * @package Zingular\Form\Service\Event
 */
interface EventHandlerInterface
{
    /**
     * @param string $type
     * @param array $data
     */
    public function dispatch($type,array $data = array());

    /**
     * @param string $type
     * @param callable $callable
     */
    public function addListener($type,$callable);
}