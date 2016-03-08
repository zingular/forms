<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 10-2-2016
 * Time: 18:06
 */

namespace Zingular\Forms\Service\Bridge\Event;


/**
 * Class Event
 * @package Zingular\Forms\Service\Bridge\Event
 */
class Event
{
    /**
     * @var string
     */
    protected $type;

    /**
     * Event constructor.
     * @param string $type
     */
    public function __construct($type)
    {
        $this->type = $type;
    }


}