<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 17-3-2016
 * Time: 20:49
 */

namespace Zingular\Forms\Events;

/**
 * Interface EventDispatcherInterface
 * @package Zingular\Forms\Service\Bridge\Event
 */
interface EventDispatcherInterface
{
    /**
     * @param string $type
     * @param callable $callable
     */
    public function addEventListener($type,$callable);
}