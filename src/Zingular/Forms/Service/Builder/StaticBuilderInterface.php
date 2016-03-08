<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 3-3-2016
 * Time: 20:47
 */

namespace Zingular\Forms\Service\Builder;


use Zingular\Forms\Component\Container\BuildableInterface;

/**
 * Interface StaticBuilderInterface
 * @package Zingular\Forms\Service\Builder
 */
interface StaticBuilderInterface
{
    /**
     * @param BuildableInterface $container
     */
    public function build(BuildableInterface $container);
}