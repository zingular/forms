<?php

namespace Zingular\Forms\Service\Builder\Form;
use Zingular\Forms\Plugins\Builders\Form\FormBuilderInterface;

/**
 * Interface FormBuilderFactoryInterface
 */
interface FormBuilderFactoryInterface
{
    /**
     * @param string $type
     * @return FormBuilderInterface
     */
    public function create($type);
}