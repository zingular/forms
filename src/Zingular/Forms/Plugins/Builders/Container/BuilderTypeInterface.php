<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 19:38
 */

namespace Zingular\Forms\Plugins\Builders\Container;

/**
 * Interface BuilderTypeInterface
 * @package Zingular\Form\Service\Builder
 */
interface BuilderTypeInterface extends BuilderInterface
{
    /**
     * @return string
     */
    public function getBuilderName();
}