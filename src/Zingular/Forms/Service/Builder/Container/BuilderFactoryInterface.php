<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 19:53
 */

namespace Zingular\Forms\Service\Builder\Container;
use Zingular\Forms\Plugins\Builders\Container\BuilderInterface;

/**
 * Interface BuilderFactoryInterface
 * @package Zingular\Form\Service\Builders
 */
interface BuilderFactoryInterface
{
    /**
     * @param string $type
     * @return BuilderInterface
     */
    public function create($type);
}