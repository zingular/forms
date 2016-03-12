<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 9-3-2016
 * Time: 21:42
 */

namespace Zingular\Forms\Component\Elements\Contents;
use Zingular\Forms\Component\FormState;

/**
 * Interface ContentInterface
 * @package Zingular\Forms\Component\Element\Content
 */
interface ContentInterface
{
    /**
     * @param FormState $state
     */
    public function compile(FormState $state);
}