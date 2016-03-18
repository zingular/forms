<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 25-10-2015
 * Time: 11:14
 */

namespace Zingular\Forms;
use Zingular\Forms\Extension\DefaultExtension;
use Zingular\Forms\Extension\TestExtension;


use Zingular\Forms\Plugins\Builders\Form\TestFormBuilder3;
use Zingular\Forms\Plugins\Builders\Form\TestFormBuilder4;
use Zingular\Forms\Service\Bridge\Orm\GetterSetterOrmHandler;
use Zingular\Forms\Service\Bridge\Orm\OrmHandlerAggregator;
use Zingular\Forms\Service\Bridge\Orm\PublicPropertyOrmHandler;
use Zingular\Forms\Service\Bridge\Translation\ArrayTranslator;

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
       // $construct->addExtension(new DefaultExtension());
        $construct->addExtension(new TestExtension());

        print_rf($construct->getRegisteredExtensions());

        // prepare translator
        $translator = new ArrayTranslator();

        // error translations
        $translator->setTranslation('error.validator.test','Test');
        $translator->setTranslation('error.validator.required',"Field '{control}' is required!");
        $translator->setTranslation('error.validator.valueIsTest','Value cannot be test!');
        $translator->setTranslation('error.validator.regex','Value {value} not valid!');
        $translator->setTranslation('error.validator.invalidRegex','Invalid regex: {regex}!');
        $translator->setTranslation('error.validator.maxLength','Value should not be longer than {max} characters!');

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

        // set control names
        $translator->setTranslation('control.question','Question');
        $translator->setTranslation('control.lastname','Lastname');

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
        $form = $construct->buildForm(new TestFormBuilder4(),'testForm',$model);





        $form->setDefaultValue('checkit',true);
        $form->setDefaultValue('hobbies','a:3:{s:6:"hobby1";s:1:"1";s:6:"hobby2";s:1:"2";s:6:"hobby3";s:1:"6";}');

        echo $form->render();
        print_rf($form->getValues());

        print_rf($form->getValue('/hobbies/hobby1'));

        print_rf($model);

        echo microtime(true) - $start;

        echo
        '
        </body>
        </html>
        ';
    }
}
