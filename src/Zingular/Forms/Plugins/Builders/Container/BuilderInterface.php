<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 3-3-2016
 * Time: 20:47
 */

namespace Zingular\Forms\Plugins\Builders\Container;

use Zingular\Forms\Component\Containers\BuildableInterface;

/**
 * Interface BuilderInterface
 * @package Zingular\Forms\Service\Builder
 */
interface BuilderInterface
{
    const START = 0;
    const END = -1;

    /**
     * @param BuildableInterface $container
     */
    public function build(BuildableInterface $container);
}