<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 19:49
 */

namespace Zingular\Forms\Service\Builder;


use Zingular\Forms\Component\Container\Container;

/**
 * Class AbstractRegisterableBuilder
 * @package Zingular\Form\Service\Builder
 */
abstract class AbstractRegisterableBuilder implements RegisterableBuilderInterface
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
     * @param Container $container
     */
    abstract public function build(Container $container);


    /**
     * @return string
     */
    public function getBuilderName()
    {
        return $this->name;
    }
}