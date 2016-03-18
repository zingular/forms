<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 5-2-2016
 * Time: 19:13
 */

namespace Zingular\Forms\Plugins\Builders\Prototype;

use Zingular\Forms\Component\Containers\Aggregator;
use Zingular\Forms\Component\Containers\Container;
use Zingular\Forms\Component\Containers\Field;
use Zingular\Forms\Component\Containers\Fieldset;
use Zingular\Forms\Component\Containers\Form;
use Zingular\Forms\Component\Containers\PrototypesInterface;
use Zingular\Forms\Component\Containers\Row;
use Zingular\Forms\Component\Elements\Contents\Content;
use Zingular\Forms\Component\Elements\Contents\Html;
use Zingular\Forms\Component\Elements\Contents\HtmlTag;
use Zingular\Forms\Component\Elements\Contents\Label;
use Zingular\Forms\Component\Elements\Controls\Button;
use Zingular\Forms\Component\Elements\Controls\Checkbox;
use Zingular\Forms\Component\Elements\Controls\Input;
use Zingular\Forms\Component\Elements\Controls\Select;
use Zingular\Forms\Component\Elements\Controls\Textarea;
use Zingular\Forms\Component\Elements\Contents\View as ViewComponent;
use Zingular\Forms\View;

/**
 * Class BasePrototypeBuilder
 * @package Zingular\Form
 */
class BasePrototypeBuilder implements PrototypeBuilderInterface
{
    /**
     * @param PrototypesInterface $prototypes
     */
    public function buildPrototypes(PrototypesInterface $prototypes)
    {
        // manipulate container base prototypes
        $this->buildFormPrototype($prototypes->getFormPrototype());
        $this->buildContainerPrototype($prototypes->getContainerPrototype());
        $this->buildFieldsetPrototype($prototypes->getFieldsetPrototype());
        $this->buildFieldPrototype($prototypes->getFieldPrototype());
        $this->buildRowPrototype($prototypes->getRowPrototype());
        $this->buildAggregatorPrototype($prototypes->getAggregatorPrototype());

        // manipulate control base prototypess
        $this->buildInputPrototype($prototypes->getInputPrototype());
        $this->buildCheckboxPrototype($prototypes->getCheckboxPrototype());
        $this->buildSelectPrototype($prototypes->getSelectPrototype());
        $this->buildTextareaPrototype($prototypes->getTextareaPrototype());
        $this->buildButtonPrototype($prototypes->getButtonPrototype());

        // manipulate content base prototypes
        $this->buildContentPrototype($prototypes->getContentPrototype());
        $this->buildLabelPrototype($prototypes->getLabelPrototype());
        $this->buildHtmlPrototype($prototypes->getHtmlPrototype());
        $this->buildHtmlTagPrototype($prototypes->getHtmlTagPrototype());
        $this->buildViewPrototype($prototypes->getViewPrototype());
    }

    /*****************************************************************
     *
     ****************************************************************/


    /**
     * @param Form $form
     */
    protected function buildFormPrototype(Form $form)
    {
        $form
            ->setCssBaseTypeClass('zingularForm')
            ->setViewName(View::FORM)
            ->setBaseType('form');
    }

    /**
     * @param Container $container
     */
    protected function buildContainerPrototype(Container $container)
    {
        $container
            ->setCssBaseTypeClass('type_container')
            ->setViewName(View::CONTAINER)
            ->setBaseType('container');

    }

    /**
     * @param Fieldset $fieldset
     */
    protected function buildFieldsetPrototype(Fieldset $fieldset)
    {
        $fieldset
            ->setCssBaseTypeClass('type_fieldset')
            ->setViewName(View::FIELDSET)
            ->setBaseType('fieldset');
    }

    /**
     * @param Field $field
     */
    protected function buildFieldPrototype(Field $field)
    {
        $field
            ->setCssBaseTypeClass('type_field')
            ->setViewName(View::FIELD)
            ->setBaseType('field');
    }

    /**
     * @param Row $row
     */
    protected function buildRowPrototype(Row $row)
    {
        $row->setCssBaseTypeClass('type_row')
            ->setViewName(View::ROW)
            ->setBaseType('row');
    }

    /**
     * @param Aggregator $aggregator
     */
    protected function buildAggregatorPrototype(Aggregator $aggregator)
    {
        $aggregator
            ->setCssBaseTypeClass('type_aggregator')
            ->setViewName(View::TRANSPARENT)
            ->setBaseType('aggregator');
    }

    /**
     * @param Input $input
     */
    protected function buildInputPrototype(Input $input)
    {
        $input
            ->setCssBaseTypeClass('ctrl')
            ->setTranslationKey('control')
            ->setBaseType('control');//->addEventListener(ComponentEvent::COMPILED,function(ComponentEvent $e){$e->getComponent()->addCssClass('compiled');});
    }

    /**
     * @param Checkbox $checkbox
     */
    protected function buildCheckboxPrototype(Checkbox $checkbox)
    {
        $checkbox
            ->setCssBaseTypeClass('ctrl')
            ->setTranslationKey('control')
            ->setBaseType('control');
    }

    /**
     * @param Select $select
     */
    protected function buildSelectPrototype(Select $select)
    {
        $select
            ->setCssBaseTypeClass('ctrl')
            ->setTranslationKey('control')
            ->setBaseType('control');
    }

    /**
     * @param Textarea $textarea
     */
    protected function buildTextareaPrototype(Textarea $textarea)
    {
        $textarea
            ->setCssBaseTypeClass('ctrl')
            ->setTranslationKey('control')
            ->setBaseType('control');
    }

    /**
     * @param Button $button
     */
    protected function buildButtonPrototype(Button $button)
    {
        $button
            ->setCssBaseTypeClass('btn')
            ->setTranslationKey('button')
            ->setBaseType('control');
    }

    /**
     * @param Content $content
     */
    protected function buildContentPrototype(Content $content)
    {
        $content
            ->setCssBaseTypeClass('cont')
            ->setBaseType('cont');
    }

    /**
     * @param Label $label
     */
    protected function buildLabelPrototype(Label $label)
    {
        $label
            ->setCssBaseTypeClass('lbl')
            ->setBaseType('lbl')
            ->setTranslationKey('{parentId}.{id}');

    }

    /**
     * @param Html $html
     */
    protected function buildHtmlPrototype(Html $html)
    {
        $html
            ->setCssBaseTypeClass('html')
            ->setBaseType('html');
    }

    /**
     * @param HtmlTag $tag
     */
    protected function buildHtmlTagPrototype(HtmlTag $tag)
    {
        $tag
            ->setCssBaseTypeClass('tag')
            ->setBaseType('tag');

    }

    /**
     * @param ViewComponent $view
     */
    protected function buildViewPrototype(ViewComponent $view)
    {
        $view
            ->setCssBaseTypeClass('view')
            ->setBaseType('view');
    }
}