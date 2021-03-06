<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 5-2-2016
 * Time: 17:57
 */

namespace Zingular\Forms\Service\Bridge\View;

use Zingular\Forms\Component\Containers\ContainerInterface;
use Zingular\Forms\Component\Containers\Form;
use Zingular\Forms\Component\Elements\Contents\ContentInterface;
use Zingular\Forms\Component\Elements\Contents\Html;
use Zingular\Forms\Component\Elements\Contents\HtmlTag;
use Zingular\Forms\Component\Elements\Contents\Label;
use Zingular\Forms\Component\Elements\Contents\View;
use Zingular\Forms\Component\Elements\Controls\Button;
use Zingular\Forms\Component\Elements\Controls\Checkbox;
use Zingular\Forms\Component\Elements\Controls\Input;
use Zingular\Forms\Component\Elements\Controls\Option;
use Zingular\Forms\Component\Elements\Controls\OptionGroup;
use Zingular\Forms\Component\Elements\Controls\Select;
use Zingular\Forms\Component\Elements\Controls\Textarea;
use Zingular\Forms\Exception\FormException;

/**
 * Class DefaultViewHandler
 * @package Zingular\Form
 */
class DefaultViewHandler extends AbstractViewHandler
{
    const FORMAT_FORM = '<form id="%s" class="%s" method="%s" action="%s" %s>%s</form>';
    const FORMAT_CONTAINER = '<div id="%s" class="%s" %s>%s</div>';
    const FORMAT_FIELDSET = '<fieldset id="%s" class="%s" %s>%s</fieldset>';
    const FORMAT_FIELD = '<div id="%s" class="%s" %s><div class="inner">%s</div></div>';
    const FORMAT_ROW = '<div id="%s" class="%s" %s><div class="inner">%s</div></div>';
    const FORMAT_INPUT = '<input type="%s" id="%s" class="%s" name="%s" value="%s" %s/>';
    const FORMAT_CHECKBOX = '<input type="%s" id="%s" class="%s" name="%s" %s %s/>';
    const FORMAT_SELECT = '<select id="%s" class="%s" name="%s" %s>%s</select>';
    const FORMAT_OPTION = '<option value="%s" %s>%s</option>';
    const FORMAT_OPTGROUP = '<optgroup label="%s" %s>%s</optgroup>';
    const FORMAT_TEXTAREA = '<textarea id="%s" class="%s" name="%s" %s>%s</textarea>';
    const FORMAT_BUTTON = '<button id="%s" type="%s" class="%s" name="%s" value="%s" %s>%s</button>';
    const FORMAT_LABEL = '<label id="%s" class="%s" for="%s" %s>%s</label>';
    const FORMAT_HTML = '<div id="%s" class="%s" %s>%s</div>';
    const FORMAT_TAG = '<%s id="%s" class="%s" %s>%s</%s>';
    const FORMAT_CONTENT = '<div id="%s" class="%s" %s>%s</div>';
    const FORMAT_VIEW = '%s';

    /******************************************************************
     * RENDER CONTAINERS
     *****************************************************************/

    /**
     * @param ContainerInterface $container
     * @return string
     */
    protected function renderContainer(ContainerInterface $container)
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
     * @param ContainerInterface $container
     * @return string
     */
    protected function renderFieldset(ContainerInterface $container)
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
     * @param ContainerInterface $container
     * @return string
     */
    protected function renderField(ContainerInterface $container)
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
     * @param ContainerInterface $container
     * @return string
     */
    protected function renderRow(ContainerInterface $container)
    {
        return sprintf
        (
            self::FORMAT_ROW,
            $container->getFullId(),
            $container->getCssClass(),
            $container->getHtmlAttributesAsString(),
            $this->renderComponents($container->getComponents()));
    }

    /**
     * @param ContainerInterface $container
     * @return string
     */
    protected function renderTransparent(ContainerInterface $container)
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
            $container->getHttpMethod(),
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
     * @param Button $button
     * @return string
     */
    protected function renderButton(Button $button)
    {
        return sprintf
        (
            self::FORMAT_BUTTON,
            $button->getFullId(),
            $button->getType(),
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
     * RENDER OPTIONS
     *****************************************************************/

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

    /**
     * @param View $view
     * @return string
     * @throws \Exception
     */
    protected function renderView(View $view)
    {
        throw new FormException(sprintf("Cannot render component '%s': rendering view-based content components is not supported in the default view handler!",$view->getFullId()));
    }

    /**
     * @param ContentInterface $label
     * @return string
     */
    protected function renderContent(ContentInterface $label)
    {
        return sprintf
        (
            self::FORMAT_CONTENT,
            $label->getFullId(),
            $label->getCssClass(),
            $label->getHtmlAttributesAsString(),
            $label->getContent()
        );
    }
}