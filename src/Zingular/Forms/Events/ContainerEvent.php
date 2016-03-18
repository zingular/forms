<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 18-3-2016
 * Time: 19:16
 */

namespace Zingular\Forms\Events;

use Zingular\Forms\Component\Containers\Container;

/**
 * Class ContainerEvent
 * @package Zingular\Forms\Events
 */
class ContainerEvent extends ComponentEvent
{
    const PRE_BUILD = 'preBuild';
    const POST_BUILD = 'proBuild';

    /**
     * @param string $type
     * @param Container $container
     * @param bool $cancellable
     */
    public function __construct($type = self::GENERIC,Container $container,$cancellable = true)
    {
        parent::__construct($type,$container,$cancellable);
    }

    /**
     * @return Container
     */
    public function getContainer()
    {
        return $this->component;
    }
}