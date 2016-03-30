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
use Zingular\Forms\Events\Event;
use Zingular\Forms\Events\FormEvent;
use Zingular\Forms\Exception\FilterException;
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
                    ->ifCondition(Condition::CURRENT_VALUE,Validator::EQUALS,'yo')
                        ->setHtmlAttribute('style','background-color:red;')
                        ->addValidator(Validator::EQUALS,'peter')
                    ->endCondition()
                ->next()
            ->addInput('lastname')->next()
            ->ifCondition(Condition::FIELD_VALUE,'firstname',Validator::STARTS_WITH,'m')
                ->addSelect('gender')->next()
            ->endCondition()
            ->addInput('jaja')->setValue('jaja')->next();
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
                        ->ifCondition(Condition::FIELD_VALUE,'firstname',Validator::STARTS_WITH,'mi')
                            ->setHtmlAttribute('style','background-color:red')
                        ->elseCondition()
                            ->setHtmlAttribute('style','background-color:green')
                        ->endCondition()
                        ->addFilter(Filter::LOWERCASE)
                        ->next()
                    ->addInput('lala')
                        ->addValidator(function($value,array $args = array())
                        {
                            //throw new ValidatorException('myType',array('lala'=>'test'));
                        })
                        ->addFilter(function($value,array $args = array())
                        {
                            throw new FilterException('myType',array('test'=>$value));
                        })
                    ->nextParent()
                        ->addAggregator('testAggregator')
                            ->addInput('test1')->next()
                            ->addInput('test2')->nextParent()
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
        $translator->setTranslation('error.validator.myType','Yes! \'{lala}\'!');
        $translator->setTranslation('error.filter.myType','Yes! \'{value}\'!');



        $iterator->addTranslator($translator);

        //
        $form->setTranslator($iterator);

        $form->addEventListener(FormEvent::VALID,array($this,'onFormValid'));

        //
    }

    /**
     * @return string
     */
    public function getFormName()
    {
        return 'test3';
    }

    /**
     * @param Event $e
     */
    public function onFormValid(Event $e)
    {
        echo $e->getType().'<br/>';
    }
}