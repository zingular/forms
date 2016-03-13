<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 12:13
 */

namespace Zingular\Forms\Plugins\Builders\Container;

use Zingular\Forms\Component\Containers\BuildableContainerInterface;
use Zingular\Forms\Component\Containers\PositionableInterface;
use Zingular\Forms\Component\FormState;

/**
 * Interface RuntimeBuilderInterface
 * @package Service\Builder
 */
interface RuntimeBuilderInterface extends PositionableInterface
{
    /**
     * @param BuildableContainerInterface $container
     * @param FormState $context
     */
    public function build(BuildableContainerInterface $container,FormState $context);
}