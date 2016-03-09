<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 19:53
 */

namespace Zingular\Forms\Service\Builder\Container;
use Zingular\Forms\Plugins\Builders\Container\RuntimeBuilderInterface;

/**
 * Interface BuilderFactoryInterface
 * @package Zingular\Form\Service\Builders
 */
interface BuilderFactoryInterface
{
    /**
     * @param string $type
     * @return RuntimeBuilderInterface
     */
    public function create($type);

    /**
     * @param string $type
     * @return bool
     */
    public function has($type);
}