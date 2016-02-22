<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 11-2-2016
 * Time: 20:02
 */

namespace Zingular\Form\Service\Bridge\View;

use Zingular\Form\Component\ComponentInterface;
use Zingular\Form\Component\Container\Container;
use Zingular\Form\Component\Container\Form;
use Zingular\Form\Component\Element\Content\Content;
use Zingular\Form\Component\Element\Content\Html;
use Zingular\Form\Component\Element\Content\HtmlTag;
use Zingular\Form\Component\Element\Content\Label;
use Zingular\Form\Component\Element\Control\AbstractControl;
use Zingular\Form\Component\Element\Control\Button;
use Zingular\Form\Component\Element\Control\Checkbox;
use Zingular\Form\Component\Element\Control\Input;
use Zingular\Form\Component\Element\Control\Select;
use Zingular\Form\Component\Element\Control\Textarea;
use Zingular\Form\Component\Element\ElementInterface;
use Zingular\Form\Service\Bridge\Translation\TranslatorInterface;
use Zingular\Form\View;

abstract class AbstractViewHandler implements ViewHandlerInterface
{
    /**
     * @param ComponentInterface $component
     * @param TranslatorInterface $translator
     * @return string
     */
    public function render(ComponentInterface $component,TranslatorInterface $translator)
    {
        if($component instanceof Container)
        {
            return $this->renderContainerType($component,$translator);
        }

        /** @var ElementInterface $element */
        $element = $component;

        return $this->renderElement($element,$translator);
    }

    /**
     * @param array $components
     * @param TranslatorInterface $translator
     * @return string
     */
    protected function renderComponents(array $components,TranslatorInterface $translator)
    {
        $buffer = '';

        /** @var ComponentInterface $component */
        foreach ($components as $component)
        {
            $buffer .= $this->render($component,$translator);
        }

        return $buffer;
    }

    /**
     * @param Container $container
     * @param TranslatorInterface $translator
     * @return string
     */
    protected function renderContainerType(Container $container,TranslatorInterface $translator)
    {
        if($container instanceof Form)
        {
            return $this->renderForm($container,$translator);
        }

        $view = $container->getViewName();

        switch($view)
        {
            case View::CONTAINER:return $this->renderContainer($container,$translator);
            case View::FIELD:return $this->renderField($container,$translator);
            case View::FIELDSET:return $this->renderFieldset($container,$translator);
            case View::TRANSPARENT:
            default:
            {
                return $this->renderTransparent($container,$translator);
            }
        }
    }

    /**
     * @param ElementInterface $element
     * @param TranslatorInterface $translator
     * @return string
     */
    protected function renderElement(ElementInterface $element,TranslatorInterface $translator)
    {
        if($element instanceof AbstractControl)
        {
            return $this->renderControl($element,$translator);
        }

        /** @var Content $content */
        $content = $element;

        return $this->renderContent($content,$translator);
    }

    /**
     * @param Content $content
     * @param TranslatorInterface $translator
     * @return string
     */
    protected function renderContent(Content $content,TranslatorInterface $translator)
    {
        if($content instanceof Label)
        {
            return $this->renderLabel($content,$translator);
        }
        elseif($content instanceof Html)
        {
            return $this->renderHtml($content,$translator);
        }
        elseif($content instanceof HtmlTag)
        {
            return $this->renderTag($content,$translator);
        }
        else
        {
            return '';
        }
    }

    /**
     * @param AbstractControl $control
     * @param TranslatorInterface $translator
     * @return string
     */
    protected function renderControl(AbstractControl $control,TranslatorInterface $translator)
    {
        if($control instanceof Checkbox)
        {
            return $this->renderCheckbox($control,$translator);
        }
        if($control instanceof Input)
        {
            return $this->renderInput($control,$translator);
        }
        elseif($control instanceof Select)
        {
            return $this->renderSelect($control,$translator);
        }
        elseif($control instanceof Button)
        {
            return $this->renderButton($control,$translator);
        }
        elseif($control instanceof Textarea)
        {
            return $this->renderTextarea($control,$translator);
        }

        return '';
    }

    /******************************************************************
     * RENDER CONTAINERS
     *****************************************************************/

    /**
     * @param Container $container
     * @param TranslatorInterface $translator
     * @return string
     */
    abstract protected function renderContainer(Container $container,TranslatorInterface $translator);

    /**
     * @param Container $container
     * @param TranslatorInterface $translator
     * @return string
     */
    abstract protected function renderFieldset(Container $container,TranslatorInterface $translator);

    /**
     * @param Container $container
     * @param TranslatorInterface $translator
     * @return string
     */
    abstract protected function renderField(Container $container,TranslatorInterface $translator);

    /**
     * @param Container $container
     * @param TranslatorInterface $translator
     * @return string
     */
    abstract protected function renderTransparent(Container $container,TranslatorInterface $translator);

    /**
     * @param Form $container
     * @param TranslatorInterface $translator
     * @return string
     */
    abstract protected function renderForm(Form $container,TranslatorInterface $translator);

    /******************************************************************
     * RENDER CONTROLS
     *****************************************************************/

    /**
     * @param Input $input
     * @param TranslatorInterface $translator
     * @return string
     */
    abstract protected function renderInput(Input $input,TranslatorInterface $translator);

    /**
     * @param Checkbox $input
     * @param TranslatorInterface $translator
     * @return string
     */
    abstract protected function renderCheckbox(Checkbox $input,TranslatorInterface $translator);

    /**
     * @param Select $select
     * @param TranslatorInterface $translator
     * @return string
     */
    abstract protected function renderSelect(Select $select,TranslatorInterface $translator);

    /**
     * @param Button $button
     * @param TranslatorInterface $translator
     * @return string
     */
    abstract protected function renderButton(Button $button,TranslatorInterface $translator);

    /**
     * @param Textarea $textarea
     * @param TranslatorInterface $translator
     * @return string
     */
    abstract protected function renderTextarea(Textarea $textarea,TranslatorInterface $translator);

    /******************************************************************
     * RENDER CONTENT
     *****************************************************************/

    /**
     * @param Label $label
     * @param TranslatorInterface $translator
     * @return string
     */
    abstract protected function renderLabel(Label $label,TranslatorInterface $translator);

    /**
     * @param Html $html
     * @param TranslatorInterface $translator
     * @return string
     */
    abstract protected function renderHtml(Html $html,TranslatorInterface $translator);

    /**
     * @param HtmlTag $tag
     * @param TranslatorInterface $translator
     * @return string
     */
    abstract protected function renderTag(HtmlTag $tag,TranslatorInterface $translator);
}