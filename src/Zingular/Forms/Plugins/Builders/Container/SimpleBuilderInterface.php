<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 3-3-2016
 * Time: 20:47
 */

namespace Zingular\Forms\Plugins\Builders\Container;

use Zingular\Forms\Component\Containers\BuildableInterface;
use Zingular\Forms\Component\Containers\PositionableInterface;

/**
 * Interface SimpleBuilderInterface
 * @package Zingular\Forms\Service\Builder
 */
interface SimpleBuilderInterface extends PositionableInterface
{
    /**
     * @param BuildableInterface $container
     * @param array $options
     */
    public function build(BuildableInterface $container,array $options = array());
}