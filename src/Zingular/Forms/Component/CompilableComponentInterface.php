<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 13-3-2016
 * Time: 19:44
 */

namespace Zingular\Forms\Component;

/**
 * Interface CompilableComponentInterface
 * @package Zingular\Forms\Component
 */
interface CompilableComponentInterface extends ComponentInterface
{
    // TODO: remove compile method completely from the component (model) interface

    /**
     * @param FormState $state
     */
    public function compile(FormState $state);
}