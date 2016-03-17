<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 17-3-2016
 * Time: 21:40
 */

namespace Zingular\Forms\Component\Containers;

/**
 * Interface ErrorContainerInterface
 * @package Zingular\Forms\Component\Containers
 */
interface ErrorContainerInterface
{
    /**
     * @param bool $recursive
     * @return array
     */
    public function getErrors($recursive = false);

    /**
     * @param bool $recursive
     * @return bool
     */
    public function hasErrors($recursive = false);
}