<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 9-3-2016
 * Time: 21:42
 */

namespace Zingular\Forms\Component\Element\Content;
use Zingular\Forms\Component\FormContext;

/**
 * Interface ContentInterface
 * @package Zingular\Forms\Component\Element\Content
 */
interface ContentInterface
{
    /**
     * @param FormContext $formContext
     */
    public function compile(FormContext $formContext);
}