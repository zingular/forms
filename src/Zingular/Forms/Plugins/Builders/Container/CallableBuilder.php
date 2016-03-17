<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 20:04
 */

namespace Zingular\Forms\Plugins\Builders\Container;

use Zingular\Forms\Component\Containers\BuildableInterface;
use Zingular\Forms\Component\FormState;

/**
 * Class CallableBuilder
 * @package Zingular\Form\Service\Builder
 */
class CallableBuilder implements BuilderInterface
{
    /**
     * @var callable
     */
    protected $callable;

    /**
     * @param $callable
     */
    public function __construct($callable)
    {
        $this->callable = $callable;
    }

    /**
     * @param BuildableInterface $container
     * @param FormState $state
     * @param array $options
     */
    public function build(BuildableInterface $container,FormState $state,array $options = array())
    {
        array_unshift($options,$container,$state);
        call_user_func_array($this->callable,$options);
    }
}