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
use Zingular\Forms\Component\Containers\Form;
use Zingular\Forms\Component\Containers\PrototypesInterface;
use Zingular\Forms\Component\DescribableInterface;

use Zingular\Forms\Component\FormState;
use Zingular\Forms\Condition;
use Zingular\Forms\Converter;
use Zingular\Forms\Filter;
use Zingular\Forms\Forms;


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
                    //->addConditionOn('firstname',Validator::MAX_LENGTH,3)
                        ->setRequired()
                        ->setHtmlAttribute('style','background-color:black;color:white;')
                    //->endCondition()
                    //->addCondition(Condition::CALLBACK,function(FormState $state){return true;})
                        ->setValue('lalala')
                    //->endCondition()
                ->nextParent()
            ->useField('fldEmail')->next()
            ->useField('fldHobbies')->next()
            ->addButton('submit')
                ->ignoreValue();

        echo 'HE!!<BR/>';

        $form->addFieldset('testCondition')
            ->addInput('yow0')->setValue(0)->next()
            ->addCondition(Condition::CALLBACK,function(){return true;})
                ->addInput('yow1')->setValue(1)->next()
                ->addInput('yow1a')->setValue('1a')->next()
                ->addInput('yow1b')->setValue('1b')->next()
                ->addCssClass('gelukt')
                ->addCondition(Condition::CALLBACK,function(){return true;})
                    ->addInput('yow2')->setValue(2)->next()
                    ->addInput('yow2a')->setValue('2a')->next()
                ->endCondition()
                ->addInput('yow3')->setValue(3)->next()
                ->addCondition(Condition::CALLBACK,function(){return true;})
                    ->addInput('yow3a')->setValue('3a')->next()
                    ->addInput('yow3b')->setValue('3b')->next()
                ->endCondition()
            ->endCondition()
            ->addInput('yow4')->setValue(4);


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
     * @param Form $form
     * @return mixed
     */
    public function configureForm(Form $form)
    {
        // TODO: Implement configureForm() method.
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