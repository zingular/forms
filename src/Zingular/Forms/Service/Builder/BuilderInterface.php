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
 * Interface BuilderInterface
 * @package Zingular\Forms\Service\Builder
 */
interface BuilderInterface
{
    /**
     * @param BuildableInterface $container
     */
    public function build(BuildableInterface $container);
}