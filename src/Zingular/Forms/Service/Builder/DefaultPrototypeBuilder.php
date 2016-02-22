<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 5-2-2016
 * Time: 19:13
 */

namespace Zingular\Forms\Service\Builder;

use Zingular\Forms\Component\Container\Prototypes;

/**
 * Class DefaultPrototypeBuilder
 * @package Zingular\Form
 */
class DefaultPrototypeBuilder implements PrototypeBuilderInterface
{
    /**
     * @param Prototypes $prototypes
     */
    public function buildPrototypes(Prototypes $prototypes)
    {
        // manipulate container base prototypes
        $prototypes->getContainerPrototype()->setCssBaseTypeClass('type_container');
        $prototypes->getFieldsetPrototype()->setCssBaseTypeClass('type_fieldset');
        $prototypes->getFieldPrototype()->setCssBaseTypeClass('type_field');
        $prototypes->getAggregatorPrototype()->setCssBaseTypeClass('type_aggregator');

        // manipulate control base prototypes
        $prototypes->getInputPrototype()->setCssBaseTypeClass('ctrl');
        $prototypes->getSelectPrototype()->setCssBaseTypeClass('ctrl');
        $prototypes->getTextareaPrototype()->setCssBaseTypeClass('ctrl');
        $prototypes->getButtonPrototype()->setCssBaseTypeClass('ctrl');

        // manipulate content base prototypes
        $prototypes->getLabelPrototype()->setCssBaseTypeClass('lbl');
        $prototypes->getHtmlPrototype()->setCssBaseTypeClass('html');
        $prototypes->getHtmlTagPrototype()->setCssBaseTypeClass('tag');

        $prototypes->defineSelect('selecter');

        $prototypes->defineFieldset('test1234')
            ->addInput('testInput')->nextSibling()
            ->useSelect('selecter','aapje');




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
        $prototypes
            ->defineFieldset('myContainer')
                ->addField('myField')
                    ->addSelect('mySelect')->back()
                ->addField('myField2')
                    ->addInput('test');
        //echo $prototypes->getComponent('myContainer')->getId();


        //print_rf($prototypes->describe(true));

    }
}