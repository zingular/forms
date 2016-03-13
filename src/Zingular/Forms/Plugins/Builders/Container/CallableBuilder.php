<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 20:04
 */

namespace Zingular\Forms\Plugins\Builders\Container;

use Zingular\Forms\Component\Containers\BuildableContainerInterface;
use Zingular\Forms\Component\Containers\BuildableInterface;

use Zingular\Forms\Component\FormState;


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
     * @param BuildableContainerInterface $container
     * @param FormState $context
     */
    public function build(BuildableContainerInterface $container,FormState $context)
    {
        call_user_func($this->callable,$container);
    }
}