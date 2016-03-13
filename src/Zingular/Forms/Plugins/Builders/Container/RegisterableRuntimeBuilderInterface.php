<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 19:38
 */

namespace Zingular\Forms\Plugins\Builders\Container;


/**
 * Interface RegisterableRuntimeBuilderInterface
 * @package Zingular\Form\Service\Builder
 */
interface RegisterableRuntimeBuilderInterface extends RuntimeBuilderInterface
{
    /**
     * @return string
     */
    public function getBuilderName();
}