<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 19:38
 */

namespace Zingular\Forms\Plugins\Builders\Container;


/**
 * Interface RegisterableBuilderInterface
 * @package Zingular\Form\Service\Builder
 */
interface RegisterableBuilderInterface extends RuntimeBuilderInterface
{
    /**
     * @return string
     */
    public function getBuilderName();
}