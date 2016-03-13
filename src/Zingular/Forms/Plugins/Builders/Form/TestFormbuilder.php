<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 9-3-2016
 * Time: 19:38
 */

namespace Zingular\Forms\Plugins\Builders\Form;

use Zingular\Forms\Aggregation;
use Zingular\Forms\Component\Containers\BuildableInterface;
use Zingular\Forms\Component\Containers\Form;
use Zingular\Forms\Component\Containers\PrototypesInterface;
use Zingular\Forms\Component\TestCompoment;

use Zingular\Forms\Converter;
use Zingular\Forms\CssClass;
use Zingular\Forms\Exception\ValidationException;
use Zingular\Forms\Filter;
use Zingular\Forms\InputType;
use Zingular\Forms\Plugins\Builders\Container\RuntimeBuilderAggregator;
use Zingular\Forms\Plugins\Builders\Container\DateTimeSelectBuilder;
use Zingular\Forms\Types;
use Zingular\Forms\Validator;

/**
 * Class TestFormbuilder
 * @package Zingular\Forms\Plugins\Builders\Form
 */
class TestFormbuilder implements  FormBuilderInterface
{
    /**
     * @param PrototypesInterface $form
     */
    public function buildPrototypes(PrototypesInterface $form)
    {
        $form->defineFieldset(Types::FIELDSET_PERSONALIA);
        $form->defineField(Types::FIELD_NAME);
        $form->defineInput(Types::INPUT_TEXT);
        $form->defineInput(Types::INPUT_EMAIL)->setConverter(Converter::SERIALIZE);
        $form->defineField(Types::FIELD_QUESTION);
        $form->defineTextarea(Types::TEXTAREA_QUESTION)->cols()->rows();
        $form->defineInput('address')->setInputType(InputType::PASSWORD);
    }

    /**
     * @param BuildableInterface $form
     */
    public function buildForm(BuildableInterface $form)
    {
        $form->useInput('address');

        // ADD TOP SUBMIT BUTTON
        $form->addButton('submit')->ignoreValue()->next()
        // FIELDSET PERSONALIA
        ->useFieldset(Types::FIELDSET_PERSONALIA)
        ->useField(Types::FIELD_NAME)
            ->useInput(Types::INPUT_TEXT)->setRequired()->addCssClass(CssClass::MEDIUM)->next()
            ->useInput(Types::INPUT_EMAIL)
                ->addValidator('doValidate')
                ->addValidator(Validator::REGEX,'/.+/')
                ->addFilter(Filter::UPPERCASE)
                ->addFilter(Filter::LOWERCASE)
                ->addFilter(Filter::TRIM_RIGHT,'m')
                ->addFilter(Filter::FORCE_TRAILING,'/')
                ->addFilter(Filter::FORCE_LEADING,'/')
                ->nextParent()
        ->useField(Types::FIELD_QUESTION)->showErrors(true)
            ->useTextarea(Types::TEXTAREA_QUESTION)->setRequired()->nextParent()
        ->addFieldset('fsHobbies')
            ->addField('fldTestSelect')
                ->addSelect('testSelect')->setOptions(array($this,'getOptions'))->nextParent()
            ->addLabel('description')->setContent('bladibla')->nextParent()
            ->addField('fldHobby1')
                ->addInput('hobby1')
                    ->setValue('aa')
                    ->setEmptyStringIsValue(false)
                    ->addValidator(array($this,'testValidator'))
                    ->addFilter(array($this,'testFilter'))
                    ->trimValue(true)
                    ->persistent(true)
                    ->nextParent()
            ->addField('myField')
                ->addSelect('lalala')->nextParent()
            ->addFieldset('fsBirthday')
                ->addField('fldBirthday')
                    ->addAggregator('dateSelect')
                        ->setBuilder((new RuntimeBuilderAggregator())
                        ->addBuilder(new DateTimeSelectBuilder()))
                        ->setAggregationType(Aggregation::DATE_TIME_SELECT)
                        ->nextParent(3)
        ->addFieldset('fsNew')->setOptions(array($this,'getOptions'))->next()
        ->useFieldset('test1234')->next()
        ->addContainer('myContainer')->next()
        ->addFieldset('fsTestRow')
            ->addRow('testRow')
                ->addInput('testRowInput1')->next()
                ->addInput('testRowInput2')->nextParent()
            ->addRow('testRow2')
                ->addInput('testRowInput3')->next()
                ->addInput('tesstRowInput4')->nextParent(2)
        ->addButton('submit')->onClick(array($this,'test'))->ignoreValue();

        $form->import(new TestCompoment(),'testComponent');
    }

    /**
     * @param Form $form
     * @return mixed
     */
    public function configureForm(Form $form)
    {
        //$form->setHttpMethod('get');

        // configure the form
        $form->persistent(false);

        // override services per-form
        //$form->setTranslator(new ArrayTranslator());

        $form->setDefaultValue('text','lalalala');
        //$form->setDefaultValue('dateSelect',array('m'=>1,'d'=>2,'Y'=>3));
        $form->setDefaultValue('dateSelect',1234516454);
        $form->setDefaultValue('question','test');
    }

    /**************************************************************************
     * CALLBACKS
     *************************************************************************/

    public function test()
    {

    }


    /**
     * @param $value
     * @throws ValidationException
     */
    public function testValidator($value)
    {
        if($value === 'test1')
        {
            throw new ValidationException('myValidator',array('value'=>$value));
        }
    }

    /**
     * @param $value
     * @return string
     * @throws ValidationException
     */
    public function testFilter($value)
    {
        return rtrim($value,'\/').'/';
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return array
        (
            'testGroup'=>array
            (
                'option1'=>'Option1',
                'option2'=>'Option2'
            ),
            'testGroup2'=>array
            (
                'option3'=>'Option1',
                'option4'=>'Option2',
                'testGroup3'=>array
                (
                    'option5'=>'Option1',
                    'option6'=>'Option2'
                )
            )
        );
    }
}