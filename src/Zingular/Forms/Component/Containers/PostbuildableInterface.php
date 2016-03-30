<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 30-3-2016
 * Time: 20:48
 */

namespace Zingular\Forms\Component\Containers;
use Zingular\Forms\Component\FormState;

/**
 * Interface PrebuildableInterface
 * @package Zingular\Forms\Component\Containers
 */
interface PostbuildableInterface extends BuildableInterface
{
    /**
     * @param FormState $state
     */
    public function postbuild(FormState $state);

    /**
     * @return string
     */
    public function getPostbuilder();
}