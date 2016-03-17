<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 17-3-2016
 * Time: 20:44
 */

namespace Zingular\Forms\Events;
use Zingular\Forms\Service\ServiceConsumerTrait;

/**
 * Class EventDispatcherTrait
 * @package Zingular\Forms\Service\Bridge\Event
 */
trait EventDispatcherTrait
{
    use ServiceConsumerTrait;

    /**
     * @var array
     */
    protected $eventListeners = array();

    /**
     * @param Event $event
     */
    protected function dispatch(Event $event)
    {
        $type = $event->getType();

        if($this->hasListenersForType($type))
        {
            foreach($this->eventListeners[$type] as $listener)
            {
                call_user_func($listener,$event);

                if($event->cancelled())
                {
                    break;
                }
            }
        }
    }

    /**
     * @param string $type
     * @param callable $callable
     */
    public function addEventListener($type, $callable)
    {
        if(!isset($this->eventListeners[$type]))
        {
            $this->eventListeners[$type] = array();
        }

        $this->eventListeners[$type][] = $callable;
    }

    /**
     * @param $type
     * @return bool
     */
    protected function hasListenersForType($type)
    {
        return isset($this->eventListeners[$type]) && count($this->eventListeners[$type]) > 0;
    }
}