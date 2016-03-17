<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 17-3-2016
 * Time: 19:52
 */

namespace Zingular\Forms\Events;

/**
 * Class Event
 * @package Zingular\Forms\Events
 */
class Event
{
    const GENERIC = 'event';

    /**
     * @var string
     */
    protected $type;

    /**
     * @var bool
     */
    protected $cancellable;

    /**
     * @var bool
     */
    protected $cancelled = false;

    /**
     * @param string $type
     * @param bool $cancellable
     */
    public function __construct($type = FormEvent::GENERIC,$cancellable = true)
    {
        $this->type = $type;
        $this->cancellable = $cancellable;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     *
     */
    public function cancel()
    {
        if($this->cancellable)
        {
            $this->cancelled = true;
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function cancelled()
    {
        return $this->cancelled;
    }
}