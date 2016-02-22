<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 28-1-2016
 * Time: 20:44
 */

namespace Zingular\Forms\Service\Bridge\Event;

/**
 * Class DefaultEventHandler
 * @package Zingular\Form\ServiceContainer\Event
 */
class DefaultEventHandler implements EventHandlerInterface
{
    /**
     * @param $type
     * @param array $data
     */
    public function dispatch($type,array $data = array())
    {
        $e = new Event($type);
    }

    /**
     * @param string $type
     * @param callable $callable
     */
    public function addListener($type, $callable)
    {
        // TODO
    }
}