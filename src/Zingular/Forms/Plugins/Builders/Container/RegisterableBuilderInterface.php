<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 13-3-2016
 * Time: 22:28
 */

namespace Zingular\Forms\Plugins\Builders\Container;

/**
 * Interface RegisterableBuilderInterface
 * @package Zingular\Forms\Plugins\Builders\Container
 */
interface RegisterableBuilderInterface
{
    /**
     * @return string
     */
    public function getBuilderName();
}