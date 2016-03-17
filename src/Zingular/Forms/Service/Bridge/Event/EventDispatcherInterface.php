<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 28-1-2016
 * Time: 20:40
 */

namespace Zingular\Forms\Service\Bridge\Event;
use Zingular\Forms\Events\Event;

/**
 * Interface EventDispatcherInterface
 * @package Zingular\Form\Service\Event
 */
interface EventDispatcherInterface
{
    /**
     * @param Event $event
     */
    public function dispatch(Event $event);

    /**
     * @param string $type
     * @param callable $callable
     */
    public function addListener($type,$callable);
}