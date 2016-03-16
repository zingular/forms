<?php
/**
 * Created by PhpStorm.
 * User: michielleideman
 * Date: 16-03-16
 * Time: 12:12
 */

namespace Zingular\Forms\Plugins\Builders\Form;

use Zingular\Forms\Component\Containers\BuildableInterface;
use Zingular\Forms\Component\Containers\ConfigurableFormInterface;
use Zingular\Forms\Component\Containers\PrototypesInterface;
use Zingular\Forms\Condition;
use Zingular\Forms\Filter;
use Zingular\Forms\Service\Bridge\Translation\ArrayTranslator;
use Zingular\Forms\Service\Bridge\Translation\TranslatorAggregator;
use Zingular\Forms\Validator;

/**
 * Class TestFormBuilder3
 * @package Zingular\Forms\Plugins\Builders\Form
 */
class TestFormBuilder3 implements FormBuilderInterface
{
    /**
     * @param PrototypesInterface $form
     */
    public function buildPrototypes(PrototypesInterface $form)
    {
        // define the field 'name'
        $form->defineField('fldName')
            ->addInput('firstname')
                ->addFilter(Filter::LOWERCASE)
                ->addValidator(Validator::EQUALS,'yo')
                ->next()
            ->addInput('lastname')->next()
            ->addCondition(Condition::FIELD_VALUE,'firstname',Validator::STARTS_WITH,'m')
                ->addSelect('gender');
    }

    /**
     * @param BuildableInterface $form
     */
    public function buildForm(BuildableInterface $form)
    {
        $form
            ->addFieldset('fsTest')
                ->useField('fldName')->next()
                ->addField('fldBirthday')
                    ->addInput('dateOfBirth')
                        ->addCondition(Condition::FIELD_VALUE,'firstname',Validator::STARTS_WITH,'mi')
                            ->setHtmlAttribute('style','background-color:red')
                        ->elseCondition()
                            ->setHtmlAttribute('style','background-color:green')
                        ->endCondition()
                        ->addFilter(Filter::LOWERCASE)->nextParent()
                ->next()
            ->addButton('submit');




        //print_rf($form->getFieldset('fsTest')->getField('fldName'));


        //print_rf($form->describe());
        // TODO: Implement buildForm() method.
    }

    /**
     * @param ConfigurableFormInterface $form
     * @return mixed
     */
    public function configureForm(ConfigurableFormInterface $form)
    {
        // set the translator
        $iterator = new TranslatorAggregator();

        // array translator
        $translator = new ArrayTranslator();
        $translator->setTranslation('fsTest.legend','Test');
        $translator->setTranslation('fsTest.description','Dit is mijn test fieldset.');
        $translator->setTranslation('error.validator.equals','Waarde moet gelijk zijn aan \'{value2}\'!');
        $iterator->addTranslator($translator);

        //
        $form->setTranslator($iterator);

        //
    }

    /**
     * @return string
     */
    public function getFormName()
    {
        // TODO: Implement getFormName() method.
    }
}