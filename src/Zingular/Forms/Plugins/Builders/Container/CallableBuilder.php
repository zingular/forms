<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 20:04
 */

namespace Zingular\Forms\Plugins\Builders\Container;

use Zingular\Forms\Component\Containers\BuildableInterface;

/**
 * Class CallableBuilder
 * @package Zingular\Form\Service\Builder
 */
class CallableBuilder implements RegisterableBuilderInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var callable
     */
    protected $callable;

    /**
     * @param $name
     * @param $callable
     */
    public function __construct($name,$callable)
    {
        $this->name = $name;
        $this->callable = $callable;
    }

    /**
     * @param BuildableInterface $container
     */
    public function build(BuildableInterface $container)
    {
        call_user_func($this->callable,$container);
    }

    /**
     * @return string
     */
    public function getBuilderName()
    {
        return $this->name;
    }
}