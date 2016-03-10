<?php
/**
 * Created by PhpStorm.
 * User: michielleideman
 * Date: 10-03-16
 * Time: 13:07
 */

namespace Zingular\Forms\Plugins\Builders\Form;

use Zingular\Forms\Component\Container\BuildableInterface;
use Zingular\Forms\Component\Container\Form;
use Zingular\Forms\Component\Container\PrototypesInterface;
use Zingular\Forms\Component\FormContext;

/**
 * Class TestFormBuilder2
 * @package Zingular\Forms\Plugins\Builders\Form
 */
class TestFormBuilder2 implements FormBuilderInterface
{
    /**
     * @param PrototypesInterface $form
     */
    public function buildPrototypes(PrototypesInterface $form)
    {
        $form->defineContent('testCallbackContent')
            ->setContentCallback(array($this,'getTestContent'));
    }

    /**
     * @param BuildableInterface $form
     */
    public function buildForm(BuildableInterface $form)
    {
        $form->useContent('testCallbackContent');
    }

    /**
     * @param Form $form
     * @return mixed
     */
    public function configureForm(Form $form)
    {
        // TODO: Implement configureForm() method.
    }

    /**********************************************************
     * CALLBACKS
     *********************************************************/

    /**
     * @param FormContext $context
     * @return string
     */
    public function getTestContent(FormContext $context)
    {
        return 'test';
    }
}