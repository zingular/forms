<?php

namespace Zingular\Forms\Events;

/**
 * Class FormEvent
 * @package Zingular\Forms\Events
 */
class FormEvent
{
    /**
     *
     */
    const GENERIC = 'generic';

    /**
     * @var string
     */
    protected $type;

    /**
     * FormEvent constructor.
     * @param $type
     * @param null $source
     */
    public function __construct($type = FormEvent::GENERIC,$source = null)
    {
        $this->type = $type;
    }
}