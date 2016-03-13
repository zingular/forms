<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 19:49
 */

namespace Zingular\Forms\Plugins\Builders\Container;



/**
 * Class AbstractRegisterableBuilder
 * @package Zingular\Form\Service\Builder
 */
abstract class AbstractRegisterableBuilder implements RegisterableRuntimeBuilderInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getBuilderName()
    {
        return $this->name;
    }
}