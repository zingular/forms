<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 20:04
 */

namespace Zingular\Forms\Service\Builder;

use Zingular\Forms\Component\Container\Container;

/**
 * Class CallableBuilder
 * @package Zingular\Form\Service\Builder
 */
class CallableBuilder extends AbstractRegisterableBuilder
{
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
        parent::__construct($name);
        $this->callable = $callable;
    }

    /**
     * @param Container $container
     */
    public function build(Container $container)
    {
        call_user_func($this->callable,$container);
    }
}