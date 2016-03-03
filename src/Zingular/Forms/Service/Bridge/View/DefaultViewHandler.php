<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 5-2-2016
 * Time: 17:57
 */

namespace Zingular\Forms\Service\Bridge\View;

use Zingular\Forms\Component\Container\Container;
use Zingular\Forms\Component\Container\Form;
use Zingular\Forms\Component\Element\Content\Html;
use Zingular\Forms\Component\Element\Content\HtmlTag;
use Zingular\Forms\Component\Element\Content\Label;
use Zingular\Forms\Component\Element\Control\Button;
use Zingular\Forms\Component\Element\Control\Checkbox;
use Zingular\Forms\Component\Element\Control\Input;
use Zingular\Forms\Component\Element\Control\Option;
use Zingular\Forms\Component\Element\Control\OptionGroup;
use Zingular\Forms\Component\Element\Control\Select;
use Zingular\Forms\Component\Element\Control\Textarea;

/**
 * Class DefaultViewHandler
 * @package Zingular\Form
 */
class DefaultViewHandler extends AbstractViewHandler
{
    const FORMAT_FORM = '<form id="%s" class="%s" method="%s" action="%s" %s>%s</form>';
    const FORMAT_CONTAINER = '<div id="%s" class="%s" %s>%s</div>';
    const FORMAT_FIELDSET = '<fieldset id="%s" class="%s" %s>%s</fieldset>';
    const FORMAT_FIELD = '<div id="%s" class="%s" %s>%s</div>';
    const FORMAT_INPUT = '<input type="%s" id="%s" class="%s" name="%s" value="%s" %s/>';
    const FORMAT_CHECKBOX = '<input type="%s" id="%s" class="%s" name="%s" %s %s/>';
    const FORMAT_SELECT = '<select id="%s" class="%s" name="%s" %s>%s</select>';
    const FORMAT_OPTION = '<option value="%s" %s>%s</option>';
    const FORMAT_OPTGROUP = '<optgroup label="%s" %s>%s</optgroup>';
    const FORMAT_TEXTAREA = '<textarea id="%s" class="%s" name="%s" %s>%s</textarea>';
    const FORMAT_BUTTON = '<button id="%s" class="%s" name="%s" value="%s" %s>%s</button>';
    const FORMAT_LABEL = '<label id="%s" class="%s" for="%s" %s>%s</label>';
    const FORMAT_HTML = '<div id="%s" class="%s" %s>%s</div>';
    const FORMAT_TAG = '<%s id="%s" class="%s" %s>%s</%s>';

    /******************************************************************
     * RENDER CONTAINERS
     *****************************************************************/

    /**
     * @param Container $container
     * @return string
     */
    protected function renderContainer(Container $container)
    {
        return sprintf
        (
            self::FORMAT_CONTAINER,
            $container->getFullId(),
            $container->getCssClass(),
            $container->getHtmlAttributesAsString(),
            $this->renderComponents($container->getComponents()));
    }

    /**
     * @param Container $container
     * @return string
     */
    protected function renderFieldset(Container $container)
    {
        return sprintf
        (
            self::FORMAT_FIELDSET,
            $container->getFullId(),
            $container->getCssClass(),
            $container->getHtmlAttributesAsString(),
            $this->renderComponents($container->getComponents()));
    }

    /**
     * @param Container $container
     * @return string
     */
    protected function renderField(Container $container)
    {
        return sprintf
        (
            self::FORMAT_FIELD,
            $container->getFullId(),
            $container->getCssClass(),
            $container->getHtmlAttributesAsString(),
            $this->renderComponents($container->getComponents()));
    }

    /**
     * @param Container $container
     * @return string
     */
    protected function renderTransparent(Container $container)
    {
        return $this->renderComponents($container->getComponents());
    }

    /**
     * @param Form $container
     * @return string
     */
    protected function renderForm(Form $container)
    {
        return sprintf
        (
            self::FORMAT_FORM,
            $container->getFullId(),
            $container->getCssClass(),
            $container->getMethod(),
            $container->getAction(),
            $container->getHtmlAttributesAsString(),
            $this->renderComponents($container->getComponents())
        );
    }

    /******************************************************************
     * RENDER CONTROLS
     *****************************************************************/

    /**
     * @param Input $input
     * @return string
     */
    protected function renderInput(Input $input)
    {
        return sprintf
        (
            self::FORMAT_INPUT,
            $input->getInputType(),
            $input->getFullId(),
            $input->getCssClass(),
            $input->getFullName(),
            $input->getInputValue(),
            $input->getHtmlAttributesAsString()
        );
    }

    /**
     * @param Checkbox $input
     * @return string
     */
    protected function renderCheckbox(Checkbox $input)
    {
        return sprintf
        (
            self::FORMAT_CHECKBOX,
            $input->getInputType(),
            $input->getFullId(),
            $input->getCssClass(),
            $input->getFullName(),
            $input->isChecked() ? 'checked="checked"' : '',
            $input->getHtmlAttributesAsString()
        );
    }

    /**
     * @param Select $select
     * @return string
     */
    protected function renderSelect(Select $select)
    {
        return sprintf
        (
            self::FORMAT_SELECT,
            $select->getFullId(),
            $select->getCssClass(),
            $select->getFullName(),
            $select->getHtmlAttributesAsString(),
            $this->renderSelectOptions($select->getOptions())
        );
    }

    /**
     * @param array $options
     * @return string
     */
    protected function renderSelectOptions(array $options)
    {
        $buffer = '';
        foreach($options as $option)
        {
            if($option instanceof Option)
            {
                $buffer .= $this->renderOption($option);
            }
            elseif($option instanceof OptionGroup)
            {
                $buffer .= $this->renderOptionGroup($option);
            }
        }
        return $buffer;
    }

    /**
     * @param OptionGroup $group
     * @return string
     */
    protected function renderOptionGroup(OptionGroup $group)
    {
        return sprintf(self::FORMAT_OPTGROUP,$group->getLabel(),$this->renderSelectOptions($group->getOptions()));
    }

    /**
     * @param Option $option
     * @return string
     */
    protected function renderOption(Option $option)
    {
        return sprintf(self::FORMAT_OPTION,$option->getValue(),$option->getLabel());
    }

    /**
     * @param Button $button
     * @return string
     */
    protected function renderButton(Button $button)
    {
        return sprintf
        (
            self::FORMAT_BUTTON,
            $button->getFullId(),
            $button->getCssClass(),
            $button->getFullName(),
            $button->getInputValue(),
            $button->getHtmlAttributesAsString(),
            $button->getId()
        );
    }

    /**
     * @param Textarea $textarea
     * @return string
     */
    protected function renderTextarea(Textarea $textarea)
    {
        return sprintf
        (
            self::FORMAT_TEXTAREA,
            $textarea->getFullId(),
            $textarea->getCssClass(),
            $textarea->getFullName(),
            $textarea->getHtmlAttributesAsString(),
            $textarea->getInputValue()
        );
    }

    /******************************************************************
     * RENDER CONTENT
     *****************************************************************/

    /**
     * @param Label $label
     * @return string
     */
    protected function renderLabel(Label $label)
    {
        return sprintf
        (
            self::FORMAT_LABEL,
            $label->getFullId(),
            $label->getCssClass(),
            $label->getFor(),
            $label->getHtmlAttributesAsString(),
            $label->getContent()
        );
    }

    /**
     * @param Html $html
     * @return string
     */
    protected function renderHtml(Html $html)
    {
        return sprintf
        (
            self::FORMAT_HTML,
            $html->getFullId(),
            $html->getCssClass(),
            'targetId',
            $html->getHtmlAttributesAsString(),
            $html->getContent()
        );
    }

    /**
     * @param HtmlTag $tag
     * @return string
     */
    protected function renderTag(HtmlTag $tag)
    {
        return sprintf
        (
            self::FORMAT_TAG,
            $tag->getTagName(),
            $tag->getFullId(),
            $tag->getCssClass(),
            $tag->getHtmlAttributesAsString(),
            $tag->getContent(),
            $tag->getTagName()
        );
    }
}