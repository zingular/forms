<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 3-3-2016
 * Time: 20:47
 */

namespace Zingular\Forms\Service\Builder;


use Zingular\Forms\Component\Container\Container;

/**
 * Interface StaticBuilderInterface
 * @package Zingular\Forms\Service\Builder
 */
interface StaticBuilderInterface
{
    /**
     * @param Container $container
     */
    public function build(Container $container);
}