<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 9-3-2016
 * Time: 21:21
 */

namespace Zingular\Forms\Component;

use Zingular\Forms\Component\Container\Container;

/**
 * Interface NavigationInterface
 * @package Zingular\Forms\Component
 */
interface NavigationInterface
{
    /**
     * @param int $level
     * @return Container
     */
    public function getParent($level = 1);

    /**
     * @return Container
     */
    public function next();

    /**
     * @param int $level
     * @return Container
     */
    public function nextParent($level = 1);
}