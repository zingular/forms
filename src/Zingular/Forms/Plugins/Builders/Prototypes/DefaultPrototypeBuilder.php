<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 5-2-2016
 * Time: 19:13
 */

namespace Zingular\Forms\Plugins\Builders\Prototypes;

use Zingular\Forms\Component\Container\PrototypesInterface;
use Zingular\Forms\Service\Builder\Prototypes\PrototypeBuilderInterface;
use Zingular\Forms\View;

/**
 * Class DefaultPrototypeBuilder
 * @package Zingular\Form
 */
class DefaultPrototypeBuilder implements PrototypeBuilderInterface
{
    /**
     * @param PrototypesInterface $prototypes
     */
    public function buildPrototypes(PrototypesInterface $prototypes)
    {
        // manipulate container base prototypes
        $prototypes->getContainerPrototype()->setCssBaseTypeClass('type_container')->setViewName(View::CONTAINER);
        $prototypes->getFieldsetPrototype()->setCssBaseTypeClass('type_fieldset')->setViewName(View::FIELDSET);
        $prototypes->getFieldPrototype()->setCssBaseTypeClass('type_field')->setViewName(View::FIELD);
        $prototypes->getAggregatorPrototype()->setCssBaseTypeClass('type_aggregator')->setViewName(View::TRANSPARENT);

        // manipulate control base prototypess
        $prototypes->getInputPrototype()->setCssBaseTypeClass('ctrl');
        $prototypes->getSelectPrototype()->setCssBaseTypeClass('ctrl');
        $prototypes->getTextareaPrototype()->setCssBaseTypeClass('ctrl');
        $prototypes->getButtonPrototype()->setCssBaseTypeClass('ctrl');

        // manipulate content base prototypes
        $prototypes->getLabelPrototype()->setCssBaseTypeClass('lbl');
        $prototypes->getHtmlPrototype()->setCssBaseTypeClass('html');
        $prototypes->getHtmlTagPrototype()->setCssBaseTypeClass('tag');

        /*
        $prototypes->defineSelect('selecter');

        $prototypes->defineFieldset('test1234')
            ->addInput('testInput')->nextSibling()
            ->useSelect('selecter','aapje');
        */



        /*
        $original = $prototypes->getContainer('test');
        var_dump($original);
        $clone = clone $original;
        echo '<hr/>';
        var_dump($clone);
        echo '<hr/>';
        var_dump($clone->getInput('testInput')->getParent());
        exit;
        */
        // add custom extended named prototypes
        /*
        $prototypes
            ->defineFieldset('myContainer')
                ->addField('myField')
                    ->addSelect('mySelect')->back()
                ->addField('myField2')
                    ->addInput('test');
        */
        //echo $prototypes->getComponent('myContainer')->getId();


        //print_rf($prototypes->describe(true));

    }
}