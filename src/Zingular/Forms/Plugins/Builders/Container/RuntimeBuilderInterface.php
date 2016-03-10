<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 12:13
 */

namespace Zingular\Forms\Plugins\Builders\Container;

use Zingular\Forms\Component\Container\BuildableInterface;
use Zingular\Forms\Component\State;

/**
 * Interface RuntimeBuilderInterface
 * @package Service\Builder
 */
interface RuntimeBuilderInterface
{
    /**
     * @param BuildableInterface $container
     * @param State $context
     */
    public function build(BuildableInterface $container,State $context);
}