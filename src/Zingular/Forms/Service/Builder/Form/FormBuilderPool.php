<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 19:36
 */

namespace Zingular\Forms\Service\Builder\Container;
use Zingular\Forms\Plugins\Builders\Form\FormBuilderInterface;
use Zingular\Forms\Service\Builder\Form\FormBuilderFactoryInterface;


/**
 * Class BuilderPool
 * @package Zingular\Form\Service\Builder
 */
class FormBuilderPool
{
    /**
     * @var array
     */
    protected $pool = array();

    /**
     * @var FormBuilderFactoryInterface
     */
    protected $factory;

    /**
     * @param FormBuilderFactoryInterface $factory
     */
    public function __construct(FormBuilderFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param FormBuilderInterface $builder
     */
    public function add(FormBuilderInterface $builder)
    {
        $this->pool[$builder->getFormName()] = $builder;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has($name)
    {
        return isset($this->pool[$name]);
    }

    /**
     * @param string $name
     * @return FormBuilderInterface
     */
    public function get($name)
    {
        if($this->has($name))
        {
            return $this->pool[$name];
        }

        $builder = $this->factory->create($name);

        $this->pool[$name] = $builder;

        return $builder;
    }
}