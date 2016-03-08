<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 20:04
 */

namespace Zingular\Forms\Service\Builder;

use Zingular\Forms\Component\Container\BuildableInterface;
use Zingular\Forms\Component\Container\Container;
use Zingular\Forms\Component\FormContext;

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
     * @param BuildableInterface $container
     * @param FormContext $context
     */
    public function build(BuildableInterface $container,FormContext $context)
    {
        call_user_func($this->callable,$container);
    }
}