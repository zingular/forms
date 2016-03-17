<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 28-1-2016
 * Time: 20:44
 */

namespace Zingular\Forms\Service\Bridge\Event;
use Zingular\Forms\Events\Event;

/**
 * Class DefaultEventDispatcher
 * @package Zingular\Form\ServiceContainer\Event
 */
class DefaultEventDispatcher implements EventDispatcherInterface
{
    /**
     * @var array
     */
    protected $listeners = array();

    /**
     * @param Event $event
     */
    public function dispatch(Event $event)
    {
        if($this->hasListenersForType($event->getType()))
        {
            foreach($this->listeners[$event->getType()] as $listener)
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
    public function addListener($type, $callable)
    {
        if(!isset($this->listeners[$type]))
        {
            $this->listeners[$type] = array();
        }

        $this->listeners[$type][] = $callable;
    }

    /**
     * @param $type
     * @return bool
     */
    protected function hasListenersForType($type)
    {
        return isset($this->listeners[$type]) && count($this->listeners[$type]) > 0;
    }
}