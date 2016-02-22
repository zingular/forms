<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 19:38
 */

namespace Zingular\Forms\Service\Builder;

/**
 * Interface RegisterableBuilderInterface
 * @package Zingular\Form\Service\Builder
 */
interface RegisterableBuilderInterface extends BuilderInterface
{
    /**
     * @return string
     */
    public function getBuilderName();
}