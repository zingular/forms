<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 9-2-2016
 * Time: 21:05
 */

namespace Zingular\Forms\Component\Containers;


use Zingular\Forms\Builder;


/**
 * Class Fieldset
 * @package Zingular\Form\Component\Container
 */
class Fieldset extends Container
{
    /**
     * @var string
     */
    protected $preBuilder = Builder::FIELDSET;
}