<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 5-2-2016
 * Time: 19:13
 */

namespace Zingular\Forms\Plugins\Builders\Prototype;

use Zingular\Forms\Builder;
use Zingular\Forms\Component\Containers\Aggregator;
use Zingular\Forms\Component\Containers\Container;
use Zingular\Forms\Component\Containers\Form;
use Zingular\Forms\Component\Containers\PrototypesInterface;
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

        // manipulate control base prototypes
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
     * CONTAINER PROTOTYPES
     ****************************************************************/

    /**
     * @param Form $form
     */
    protected function buildFormPrototype(Form $form)
    {
        $form
            ->setCssBaseTypeClass('zingularForm')
            ->setViewName(View::FORM)
            ->setComponentBaseType('form')
            ->setErrorBuilder(Builder::ERROR);
    }

    /**
     * @param Container $container
     */
    protected function buildContainerPrototype(Container $container)
    {
        $container
            ->setCssBaseTypeClass('container')
            ->setViewName(View::CONTAINER)
            ->setComponentBaseType('container')
            ->setErrorBuilder(Builder::ERROR);
    }

    /**
     * @param Container $fieldset
     */
    protected function buildFieldsetPrototype(Container $fieldset)
    {
        $fieldset
            ->setCssBaseTypeClass('fieldset')
            ->setViewName(View::FIELDSET)
            ->setComponentBaseType('fieldset')
            ->setBuilder(Builder::FIELDSET)
            ->setErrorBuilder(Builder::ERROR);
    }

    /**
     * @param Container $field
     */
    protected function buildFieldPrototype(Container $field)
    {
        $field
            ->setCssBaseTypeClass('field')
            ->setViewName(View::FIELD)
            ->setComponentBaseType('field')
            ->setBuilder(Builder::FIELD,$post = true)
            ->setErrorBuilder(Builder::ERROR);
    }

    /**
     * @param Container $row
     */
    protected function buildRowPrototype(Container $row)
    {
        $row->setCssBaseTypeClass('row')
            ->setViewName(View::ROW)
            ->setComponentBaseType('row')
            ->setErrorBuilder(Builder::ERROR);
    }

    /**
     * @param Aggregator $aggregator
     */
    protected function buildAggregatorPrototype(Aggregator $aggregator)
    {
        $aggregator
            ->setCssBaseTypeClass('aggregator')
            ->setViewName(View::TRANSPARENT)
            ->setComponentBaseType('aggregator')
            ->setErrorBuilder(Builder::ERROR);
    }

    /*****************************************************************
     * CONTROL PROTOTYPES
     ****************************************************************/

    /**
     * @param Input $input
     */
    protected function buildInputPrototype(Input $input)
    {
        $input
            ->setCssBaseTypeClass('ctrl')
            ->setTranslationKey('control.{name}')
            ->setComponentBaseType('control');
    }

    /**
     * @param Checkbox $checkbox
     */
    protected function buildCheckboxPrototype(Checkbox $checkbox)
    {
        $checkbox
            ->setCssBaseTypeClass('ctrl')
            ->setTranslationKey('control.{name}')
            ->setComponentBaseType('control');
    }

    /**
     * @param Select $select
     */
    protected function buildSelectPrototype(Select $select)
    {
        $select
            ->setCssBaseTypeClass('ctrl')
            ->setTranslationKey('control.{name}')
            ->setComponentBaseType('control');
    }

    /**
     * @param Textarea $textarea
     */
    protected function buildTextareaPrototype(Textarea $textarea)
    {
        $textarea
            ->setCssBaseTypeClass('ctrl')
            ->setTranslationKey('control.{name}')
            ->setComponentBaseType('control');
    }

    /**
     * @param Button $button
     */
    protected function buildButtonPrototype(Button $button)
    {
        $button
            ->setCssBaseTypeClass('btn')
            ->setTranslationKey('button.{name}')
            ->setComponentBaseType('control');
    }

    /*****************************************************************
     * CONTENT PROTOTYPES
     ****************************************************************/

    /**
     * @param Content $content
     */
    protected function buildContentPrototype(Content $content)
    {
        $content
            ->setCssBaseTypeClass('cont')
            ->setComponentBaseType('cont');
    }

    /**
     * @param Label $label
     */
    protected function buildLabelPrototype(Label $label)
    {
        $label
            ->setCssBaseTypeClass('lbl')
            ->setComponentBaseType('lbl')
            ->setTranslationKey('{parentId}.{id}');
    }

    /**
     * @param Html $html
     */
    protected function buildHtmlPrototype(Html $html)
    {
        $html
            ->setCssBaseTypeClass('html')
            ->setComponentBaseType('html');
    }

    /**
     * @param HtmlTag $tag
     */
    protected function buildHtmlTagPrototype(HtmlTag $tag)
    {
        $tag
            ->setCssBaseTypeClass('tag')
            ->setComponentBaseType('tag');
    }

    /**
     * @param ViewComponent $view
     */
    protected function buildViewPrototype(ViewComponent $view)
    {
        $view
            ->setCssBaseTypeClass('view')
            ->setComponentBaseType('view');
    }
}