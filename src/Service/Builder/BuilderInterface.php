<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 12:13
 */

namespace Zingular\Form\Service\Builder;

use Zingular\Form\Component\Container\Container;

/**
 * Interface BuilderInterface
 * @package Service\Builder
 */
interface BuilderInterface
{
    /**
     * @param Container $container
     */
    public function build(Container $container);
}