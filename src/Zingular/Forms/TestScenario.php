<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 25-10-2015
 * Time: 11:14
 */

namespace Zingular\Forms;
use Zingular\Forms\Exception\ValidationException;
use Zingular\Forms\Extension\DefaultExtension;
use Zingular\Forms\Extension\TestExtension;
use Zingular\Forms\Service\Bridge\Orm\GetterSetterOrmHandler;
use Zingular\Forms\Service\Bridge\Orm\OrmHandlerAggregator;
use Zingular\Forms\Service\Bridge\Orm\PublicPropertyOrmHandler;
use Zingular\Forms\Service\Bridge\Translation\ArrayTranslator;
use Zingular\Forms\Service\Builder\BuilderAggregator;
use Zingular\Forms\Service\Builder\DateTimeSelectBuilder;
use Zingular\Forms\Service\Builder\XmlBuilder;

/**
 * Class FormTester
 * @package Zingular
 */
class TestScenario
{
    /**
     *
     */
    public function __construct()
    {

        session_start();

        echo
        '
        <html>
        <head>
            <link rel="stylesheet" href="styles.css"/>
        </head>
        <body>
        ';

        $start = microtime(true);


        // create form construct
        $construct = new Construct();

        // add extensions
        $construct->addExtension(new DefaultExtension());
        $construct->addExtension(new TestExtension());

        // prepare translator
        $translator = new ArrayTranslator();

        // error translations
        $translator->setTranslation('error.test','Test');
        $translator->setTranslation('error.valueIsTest','Value cannot be test!');
        $translator->setTranslation('error.regex','Value {value} not valid!');
        $translator->setTranslation('error.invalidRegex','Invalid regex: {regex}!');
        $translator->setTranslation('error.maxLength','Value should not be longer than {max} characters!');

        // fieldset legends
        $translator->setTranslation('fsPersonalia.legend','Personalia');
        $translator->setTranslation('fsHobbies.legend','Hobbies');
        $translator->setTranslation('fsBirthday.legend','Date of birth');
        $translator->setTranslation('fsNew.legend','New test');
        $translator->setTranslation('test1234.legend','Test 1234');

        // fieldset descriptions
        $translator->setTranslation('fsBirthday.description','Please enter your date of birth.');

        // field label translations
        $translator->setTranslation('fldTestSelect.label','My test selectfield');
        $translator->setTranslation('fldBirthday.label','Date of birth');

        // set the default translator
        $construct->setTranslator($translator);

        // orm
        $ormHandler = new OrmHandlerAggregator();
        $ppOrmHandler = new PublicPropertyOrmHandler();
        $gsOrmHandler = new GetterSetterOrmHandler();
        $ormHandler->addHandler($ppOrmHandler,function($model){return is_object($model);});
        $ormHandler->addHandler($gsOrmHandler,function($model){return is_object($model);});
        $construct->setOrmHandler($ormHandler);

        // *****************************************************************

        // create a dummy model
        $model = new TestModel();

        // create a form
        $form = $construct->createForm('testForm',$model);

        // configure the form
        $form->persistent(false);

        // override services per-form
        //$form->setTranslator(new ArrayTranslator());


        // check the form specific prototypes
        //$form->getPrototypes()->getFieldsetPrototype()->setBuilderType(Builder::FIELD);

        $form->setDefaultValue('text','lalalala');
        //$form->setDefaultValue('dateSelect',array('m'=>1,'d'=>2,'Y'=>3));
        $form->setDefaultValue('dateSelect',1234516454);
        $form->setDefaultValue('question','test');


        // create a new form from a xml-builder
        /*
        $formXml = $construct->buildForm('xmlLoadedForm',new XmlBuilder('myForm.xml'));
        $formXml->addButton('submit')->ignoreValue();
        $formXml->addFieldset('xmlLoadedFormLegend');

        echo $formXml->render();
        */


        // define fields
        $form->defineFieldset(Types::FIELDSET_PERSONALIA);
        $form->defineField(Types::FIELD_NAME);
        $form->defineInput(Types::INPUT_TEXT);
        $form->defineInput(Types::INPUT_EMAIL)
            ->setConverter(Converter::SERIALIZE);
        $form->defineField(Types::FIELD_QUESTION);
        $form->defineTextarea(Types::TEXTAREA_QUESTION);
        $form->defineInput('address')->setInputType(InputType::PASSWORD);



        $form->useInput('address');

        // BUILD THE FORM
        $form
            // ADD TOP SUBMIT BUTTON
            ->addButton('submit')
                ->ignoreValue()
                ->nextSibling()
            // FIELDSET PERSONALIA
            ->useFieldset(Types::FIELDSET_PERSONALIA)
                ->useField(Types::FIELD_NAME)
                    ->useInput(Types::INPUT_TEXT)
                        ->setRequired(false)
                        ->addCssClass(CssClass::MEDIUM)
                        ->nextSibling()
                    ->useInput(Types::INPUT_EMAIL)
                        ->addValidator('doValidate')
                        ->addValidator(Validator::REGEX,'/.+/')
                        ->addFilter(Filter::UPPERCASE)
                        ->addFilter(Filter::LOWERCASE)
                        ->addFilter(Filter::TRIM_RIGHT,'m')
                        ->addFilter(Filter::FORCE_TRAILING,'/')
                        ->addFilter(Filter::FORCE_LEADING,'/')
                        ->back()
                ->useField(Types::FIELD_QUESTION)
                    ->showErrors(true)
                    ->useTextarea(Types::TEXTAREA_QUESTION)
                        ->back()
                ->addFieldset('fsHobbies')
                    ->addField('fldTestSelect')
                        ->addSelect('testSelect')
                            ->setOptions(array($this,'getOptions'))
                        ->back()
                    ->addLabel('description')
                        ->setContent('bladibla')
                        ->nextSibling()
                    ->addField('fldHobby1')
                        ->showIf(Condition::STARTS_WITH,4)
                        ->orIf(Condition::STARTS_WITH)
                        ->showIf('endsWith')
                        ->requiredIf('')
                        ->addInput('hobby1')
                            //->setValue('aa')
                            ->setEmptyStringIsValue(false)
                            ->addValidator(array($this,'testValidator'))
                            ->addFilter(array($this,'testFilter'))
                            ->trimValue(true)
                            ->persistent(true)
                            ->back()
                        ->addField('myField')
                            ->back()
                    ->addFieldset('fsBirthday')
                        ->addField('fldBirthday')
                            ->addAggregator('dateSelect')
                                ->setBuilder((new BuilderAggregator())->addBuilder(new DateTimeSelectBuilder()))
                                ->setAggregationType(Aggregation::DATE_TIME_SELECT)
                                ->back()
                        ->back()
                ->addFieldset('fsNew')
                    ->setOptions(array($this,'getOptions'))->nextSibling()
                ->useFieldset('test1234')
                    ->nextSibling()
                    //->addContainer('myContainer','myContainer')->nextSibling()

                ->addButton('submit')
                    ->onClick(array($this,'test'))
                    ->ignoreValue();
            //print_rf($form->getFieldset('fsTest')->getField('name')->getInput('text'));

            //print_rf($form->describe(true));



        //var_dump($form->getFieldset('hobbies')->getField('fldHobby1')->getInput('hobby1')->getFullId());

        //print_rf($form->describe());
        echo $form->render();

        //echo $form->getFieldset('fsPersonalia')->getFieldset('fsBirthday')->getField('fldBirthday')->getAggregator('dateSelect')->getSelect('d')->getFullName();
        //print_rf($form->describe(true));

        /*
        echo '<pre>';
        var_dump($form->getValues());
        echo '</pre>';
        */

        print_rf($form->getValues());

        print_rf($model);

        //var_dump($form->getFieldset('fsPersonalia')->getField('name')->getInput('text')->isRequired());
        echo microtime(true) - $start;

        echo
        '
        </body>
        </html>
        ';
    }


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
