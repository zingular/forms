<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 20:06
 */

namespace Zingular\Forms\Service\Builder\Form;
use Zingular\Forms\Exception\FormException;
use Zingular\Forms\Plugins\Builders\Form\FormBuilderInterface;

/**
 * Class BuilderFactoryAggregator
 * @package Zingular\Form\Service\Builder
 */
class FormBuilderFactoryAggregator implements FormBuilderFactoryInterface
{
    /**
     * @var array
     */
    protected $factories = array();

    /**
     * @param FormBuilderFactoryInterface $factory
     */
    public function add(FormBuilderFactoryInterface $factory)
    {
        $this->factories[] = $factory;
    }

    /**
     * @param string $type
     * @return FormBuilderInterface
     * @throws FormException
     */
    public function create($type)
    {
        /** @var FormBuilderFactoryInterface $factory */
        foreach($this->factories as $factory)
        {
            try
            {
                return $factory->create($type);
            }
            catch(FormException $e)
            {
                continue;
            }
        }

        throw new FormException(sprintf("Cannot create form builder: none of the factories in the factory aggregator has the requested type '%s'!",$type));
    }
}