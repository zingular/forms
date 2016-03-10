<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 8-3-2016
 * Time: 20:25
 */

namespace Zingular\Forms\Component\Container;
use Zingular\Forms\Component\ComponentInterface;

/**
 * Interface ContainerInterface
 * @package Zingular\Forms\Component\Container
 */
interface ContainerInterface extends ComponentInterface
{
    /**
     * @return array
     */
    public function getComponents();

    /**
     * @return string
     */
    public function getDataPath();
}