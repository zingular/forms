<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 12:13
 */

namespace Zingular\Forms\Plugins\Builders\Container;

use Zingular\Forms\Component\Containers\BuildableInterface;
use Zingular\Forms\Component\Containers\PositionableInterface;
use Zingular\Forms\Component\FormState;

/**
 * Interface RuntimeBuilderInterface
 * @package Service\Builder
 */
interface RuntimeBuilderInterface extends PositionableInterface
{
    /**
     * @param BuildableInterface $container
     * @param FormState $context
     */
    public function build(BuildableInterface $container,FormState $context);
}