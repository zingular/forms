<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 5-2-2016
 * Time: 19:13
 */

namespace Zingular\Forms\Plugins\Builders\Prototype;

use Zingular\Forms\Component\Containers\PrototypesInterface;
use Zingular\Forms\Events\ComponentEvent;
use Zingular\Forms\Events\Event;
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
        $prototypes->getFormPrototype()->setCssBaseTypeClass('zingularForm')->setViewName(View::FORM)->setBaseType('form');
        $prototypes->getContainerPrototype()->setCssBaseTypeClass('type_container')->setViewName(View::CONTAINER)->setBaseType('container');
        $prototypes->getFieldsetPrototype()->setCssBaseTypeClass('type_fieldset')->setViewName(View::FIELDSET)->setBaseType('fieldset');
        $prototypes->getFieldPrototype()->setCssBaseTypeClass('type_field')->setViewName(View::FIELD)->setBaseType('field');
        $prototypes->getRowPrototype()->setCssBaseTypeClass('type_row')->setViewName(View::ROW)->setBaseType('row');
        $prototypes->getAggregatorPrototype()->setCssBaseTypeClass('type_aggregator')->setViewName(View::TRANSPARENT)->setBaseType('aggregator');

        // manipulate control base prototypess
        $prototypes->getInputPrototype()->setCssBaseTypeClass('ctrl')->setTranslationKey('control')->setBaseType('control');//->addEventListener(ComponentEvent::COMPILED,function(ComponentEvent $e){$e->getComponent()->addCssClass('compiled');});
        $prototypes->getCheckboxPrototype()->setCssBaseTypeClass('ctrl')->setTranslationKey('control')->setBaseType('control');
        $prototypes->getSelectPrototype()->setCssBaseTypeClass('ctrl')->setTranslationKey('control')->setBaseType('control');
        $prototypes->getTextareaPrototype()->setCssBaseTypeClass('ctrl')->setTranslationKey('control')->setBaseType('control');
        $prototypes->getButtonPrototype()->setCssBaseTypeClass('btn')->setTranslationKey('button')->setBaseType('control');

        // manipulate content base prototypes
        $prototypes->getContentPrototype()->setCssBaseTypeClass('cont')->setBaseType('cont');
        $prototypes->getLabelPrototype()->setCssBaseTypeClass('lbl')->setBaseType('lbl')->setTranslationKey('{parent}.{basetype}.{id}');
        $prototypes->getHtmlPrototype()->setCssBaseTypeClass('html')->setBaseType('html');
        $prototypes->getHtmlTagPrototype()->setCssBaseTypeClass('tag')->setBaseType('tag');
        $prototypes->getHtmlTagPrototype()->setCssBaseTypeClass('view')->setBaseType('view');
    }
}