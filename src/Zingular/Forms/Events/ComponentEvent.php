<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 17-3-2016
 * Time: 19:50
 */

namespace Zingular\Forms\Events;
use Zingular\Forms\Component\ComponentInterface;

/**
 * Class ComponentEvent
 * @package Zingular\Forms\Events
 */
class ComponentEvent extends Event
{
    /**
     * @var ComponentInterface
     */
    protected $component;

    /**
     * @param string $type
     * @param ComponentInterface $component
     * @param bool $cancellable
     */
    public function __construct($type = self::GENERIC,ComponentInterface $component,$cancellable = true)
    {
        parent::__construct($type,$cancellable);
        $this->component = $component;
    }

    /**
     * @return ComponentInterface
     */
    public function getComponent()
    {
        return $this->component;
    }
}