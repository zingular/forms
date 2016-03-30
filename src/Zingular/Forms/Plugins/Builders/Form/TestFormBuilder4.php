<?php
/**
 * Created by PhpStorm.
 * User: michielleideman
 * Date: 18-03-16
 * Time: 10:44
 */

namespace Zingular\Forms\Plugins\Builders\Form;


use Zingular\Forms\Component\Containers\BuildableInterface;
use Zingular\Forms\Component\Containers\ConfigurableFormInterface;
use Zingular\Forms\Component\Containers\PrototypesInterface;
use Zingular\Forms\Component\Containers\SimpleBuilder;
use Zingular\Forms\Service\Bridge\Translation\ArrayTranslator;

/**
 * Class TestFormBuilder4
 * @package Zingular\Forms\Plugins\Builders\Form
 */
class TestFormBuilder4 implements FormBuilderInterface
{
    /**
     * @param PrototypesInterface $form
     */
    public function buildPrototypes(PrototypesInterface $form)
    {
        // TODO: Implement buildPrototypes() method.
    }

    /**
     * @param BuildableInterface $form
     */
    public function buildForm(BuildableInterface $form)
    {
        $wrapper = new SimpleBuilder($form);

        $wrapper->startFieldset('firstFieldset');
        $wrapper->startField('myFirstField');

        $wrapper->addInput('yow');

        $wrapper->startField('myField');
        $wrapper->addInput('yow2');
        $wrapper->addInput('yow3')->setRequired();
        $wrapper->startFieldset('personalia');
        $wrapper->startField('fldName');
        $wrapper->addInput('lala')
            ->setHtmlAttribute('placeholder','lala');


        $wrapper->addSubmit();
    }

    /**
     * @param ConfigurableFormInterface $form
     * @return mixed
     */
    public function configureForm(ConfigurableFormInterface $form)
    {
        $translator = new ArrayTranslator();

        $translator->setTranslation('error.translation.keyWildcardUnknown',"Unknown translation key wildcard: '{wildcard}'");

        //$form->setTranslator($translator);
    }

    /**
     * @return string
     */
    public function getFormName()
    {
        return 'testSimpleBuilder';
    }
}