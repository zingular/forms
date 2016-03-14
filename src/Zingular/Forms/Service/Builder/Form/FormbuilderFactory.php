<?php

namespace Zingular\Forms\Service\Builder\Form;
use Zingular\Forms\Exception\FormException;
use Zingular\Forms\Forms;
use Zingular\Forms\Plugins\Builders\Form\FormBuilderInterface;
use Zingular\Forms\Plugins\Builders\Form\TestFormBuilder2;

/**
 * Class FormBuilderFactory
 * @package Zingular\Forms\Service\Builder\Form
 */
class FormBuilderFactory implements FormBuilderFactoryInterface
{
    /**
     * @param string $type
     * @return FormBuilderInterface
     * @throws FormException
     */
    public function create($type)
    {
        switch($type)
        {
            case Forms::TEST: return new TestFormBuilder2();
        }

        throw new FormException(sprintf("Cannot create form builder: unknown form builder type '%s'!"),$type);
    }
}