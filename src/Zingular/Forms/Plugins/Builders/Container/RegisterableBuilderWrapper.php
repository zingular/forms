<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 19:51
 */

namespace Zingular\Forms\Plugins\Builders\Container;

use Zingular\Forms\Component\Container\BuildableInterface;

use Zingular\Forms\Component\State;


/**
 * Class RegisterableBuilderWrapper
 * @package Zingular\Form\Service\Builder
 */
class RegisterableBuilderWrapper extends AbstractRegisterableBuilder
{
    /**
     * @var RuntimeBuilderInterface
     */
    protected $builder;

    /**
     * @param $name
     * @param RuntimeBuilderInterface $builder
     */
    public function __construct($name,RuntimeBuilderInterface $builder)
    {
        parent::__construct($name);
        $this->builder = $builder;
    }


    /**
     * @param BuildableInterface $container
     * @param State $context
     */
    public function build(BuildableInterface $container,State $context)
    {
        $this->builder->build($container,$context);
    }
}