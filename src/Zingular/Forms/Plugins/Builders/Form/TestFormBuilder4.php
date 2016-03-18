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

        $wrapper->addInput('yow');
        $wrapper->nextField('myField');
        $wrapper->addInput('yow2');
        $wrapper->addInput('yow3')->setRequired();
        $wrapper->nextFieldset('personalia','fldName');
        $wrapper->addInput('lala');
        $wrapper->addSubmit();
    }

    /**
     * @param ConfigurableFormInterface $form
     * @return mixed
     */
    public function configureForm(ConfigurableFormInterface $form)
    {
        // TODO: Implement configureForm() method.
    }

    /**
     * @return string
     */
    public function getFormName()
    {
        return 'testSimpleBuilder';
    }
}