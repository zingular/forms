<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 17-3-2016
 * Time: 19:52
 */

namespace Zingular\Forms\Events;
use Zingular\Forms\Exception\FormException;

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
     * @throws FormException
     */
    public function cancel()
    {
        if($this->cancellable !== true)
        {
            throw new FormException(sprintf("Cannot cancel event of type '%s': event is not cancellable!",$this->type),'event.notCancellable',array('type'=>$this->type));
        }
    }

    /**
     * @return bool
     */
    public function cancellable()
    {
        return $this->cancellable;
    }

    /**
     * @return bool
     */
    public function cancelled()
    {
        return $this->cancelled;
    }
}