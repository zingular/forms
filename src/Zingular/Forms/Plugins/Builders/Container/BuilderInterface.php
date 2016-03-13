<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 3-3-2016
 * Time: 20:47
 */

namespace Zingular\Forms\Plugins\Builders\Container;

use Zingular\Forms\Component\Containers\BuildableContainerInterface;
use Zingular\Forms\Component\Containers\PositionableInterface;

/**
 * Interface BuilderInterface
 * @package Zingular\Forms\Service\Builder
 */
interface BuilderInterface extends PositionableInterface
{
    /**
     * @param BuildableContainerInterface $container
     */
    public function build(BuildableContainerInterface $container);
}