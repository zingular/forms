<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 9-3-2016
 * Time: 21:42
 */

namespace Zingular\Forms\Component\Elements\Contents;

/**
 * Interface ContentInterface
 * @package Zingular\Forms\Component\Element\Content
 */
interface ContentInterface
{
    /**
     * @return string
     * @throws \Exception
     */
    public function getContent();
}