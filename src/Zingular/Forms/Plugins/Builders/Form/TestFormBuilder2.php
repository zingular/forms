<?php
/**
 * Created by PhpStorm.
 * User: michielleideman
 * Date: 10-03-16
 * Time: 13:07
 */

namespace Zingular\Forms\Plugins\Builders\Form;

use Zingular\Forms\Aggregation;
use Zingular\Forms\Builder;
use Zingular\Forms\Component\Containers\BuildableInterface;
use Zingular\Forms\Component\Containers\ConfigurableFormInterface;
use Zingular\Forms\Component\Containers\PrototypesInterface;
use Zingular\Forms\Component\DescribableInterface;
use Zingular\Forms\Component\FormState;
use Zingular\Forms\Condition;
use Zingular\Forms\Converter;
use Zingular\Forms\Filter;
use Zingular\Forms\Forms;
use Zingular\Forms\Validator;

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
                ->addInput('firstname')
                    ->setValue('tap')->next()
                ->addInput('lastname')
                    ->ifCondition(Condition::FIELD_VALUE,'firstname',Validator::MAX_LENGTH,3)
                        ->setRequired()
                        ->setHtmlAttribute('style','background-color:black;color:white;')
                    ->endCondition()
                    ->ifCondition(Condition::CALLBACK,function(){return true;})
                        ->setValue('lalala')
                    ->endCondition()
                ->nextParent()
            ->useField('fldEmail')->next()
            ->useField('fldHobbies')->next()
            ->addButton('submit')
                ->ignoreValue();

       $form->addFieldset('testCondition')

            ->ifCondition(Condition::FIELD_VALUE,'firstname',Validator::ENDS_WITH,'test')
                ->orCondition(Condition::FALSE)
                ->orCondition(Condition::FALSE)
                ->addInput('sow1')->setValue('sow!')->next()
            ->elseCondition()
                ->addInput('sowElse')->setValue('sowElse')->next()
            ->endCondition()

            ->addInput('sow2')->setValue('sow2')
                ->ifCondition(Condition::COMPONENT_PROPERTY,'firstname','isRequired')
                    ->orCondition(Condition::FALSE)
                    ->setHtmlAttribute('style','background-color:red;');


        $form->addFieldset('fsDates')
            ->addRow('dates')
                ->addAggregator('birthday')
                    ->setBuilder(Builder::DATE_TIME_SELECT)
                    ->setAggregationType(Aggregation::DATE_TIME_SELECT)
                    ->setConverter(Converter::TIMESTAMP_TO_STRING)
                ->nextParent()
            ->addRow('newRow')
                ->addInput('date')
                    ->setConverter(Converter::TIMESTAMP_TO_STRING);



        //$form->addCheckbox('checkit');

            //->applyConditions();

        /*
        $form->addContent('testCallback')->setContentCallback(function(FormState $state,Content $content)
        {
            $hobbies = $content->getParent()
                ->getContainer('fsPersonalia')
                ->getContainer('fldHobbies')
                ->getContainer('hobbies');

            return $state->getValue('/hobbies',$hobbies);
        });
*/

        if($form instanceof DescribableInterface)
        {
            //print_rf($form->describe());
        }




        //$form->getFieldset('fsPersonalia')->removeComponent('submit');

        //$form->useContent('testCallbackContent');
    }

    /**
     * @param ConfigurableFormInterface $form
     * @return mixed
     */
    public function configureForm(ConfigurableFormInterface $form)
    {
        $form->setHttpMethod('post');
    }

    /**
     * @return string
     */
    public function getFormName()
    {
        return Forms::TEST;
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