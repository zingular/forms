<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 12-3-2016
 * Time: 11:05
 */

namespace Zingular\Forms\Component\Containers;

/**
 * Interface PositionableInterface
 * @package Zingular\Forms\Component\Containers
 */
interface PositionableInterface
{
    const POSITION_START = 0;
    const POSITION_END = -1;
    const POSITION_DEFAULT = -2;
    const POSITION_AFTER_LAST = -3;
}