<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 20:04
 */

namespace Zingular\Forms\Plugins\Builders\Container;


/**
 * Class CallableBuilder
 * @package Zingular\Form\Service\Builder
 */
class CallableBuilderType extends CallableBuilder implements BuilderTypeInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @param $name
     * @param $callable
     */
    public function __construct($name,$callable)
    {
        parent::__construct($callable);
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