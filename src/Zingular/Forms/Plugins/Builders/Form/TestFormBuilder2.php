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
use Zingular\Forms\Component\Element\Content\Content;
use Zingular\Forms\Component\FormState;
use Zingular\Forms\Converter;
use Zingular\Forms\Filter;


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
        // define email inpu
        $form->defineInput('email')
            ->setRequired()
                ->addFilter(Filter::TRIM)
                ->addFilter(Filter::FORCE_TRAILING,'.nl')
                ->setConverter(Converter::SERIALIZE);

        // define email field
        $form->defineField('fldEmail')
            ->useInput('email');

        // define test aggregator

        $form->defineField('fldHobbies')
            ->addAggregator('hobbies')
                ->setConverter(Converter::SERIALIZE)
                ->addInput('hobby1')->next()
                ->addInput('hobby2')->next()
                ->addInput('hobby3');

        $form->defineContent('testCallbackContent')
            ->setContentCallback(array($this,'getTestContent'));
    }

    /**
     * @param BuildableInterface $form
     */
    public function buildForm(BuildableInterface $form)
    {
        $form->addFieldset('fsPersonalia')
            ->addField('fldName')
                ->addInput('firstname')->next()
                ->addInput('lastname')->nextParent()
            ->useField('fldEmail')->next()
            ->useField('fldHobbies')->next()
            ->addButton('submit')
                ->ignoreValue();

        $form->addContent('testCallback')->setContentCallback(function(FormState $state,Content $content)
        {
            $hobbies = $content->getParent()
                ->getContainer('fsPersonalia')
                ->getContainer('fldHobbies')
                ->getContainer('hobbies');

            return $state->getValue('/hobbies',$hobbies);
        });

        //$form->getFieldset('fsPersonalia')->removeComponent('submit');

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
     * @param FormState $context
     * @return string
     */
    public function getTestContent(FormState $context)
    {
        return $context->getFormId();
    }
}