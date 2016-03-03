<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 11-2-2016
 * Time: 20:02
 */

namespace Zingular\Forms\Service\Bridge\View;

use Zingular\Forms\Component\ComponentInterface;
use Zingular\Forms\Component\Container\Container;
use Zingular\Forms\Component\Container\Form;
use Zingular\Forms\Component\Element\Content\Content;
use Zingular\Forms\Component\Element\Content\Html;
use Zingular\Forms\Component\Element\Content\HtmlTag;
use Zingular\Forms\Component\Element\Content\Label;
use Zingular\Forms\Component\Element\Control\AbstractControl;
use Zingular\Forms\Component\Element\Control\Button;
use Zingular\Forms\Component\Element\Control\Checkbox;
use Zingular\Forms\Component\Element\Control\Input;
use Zingular\Forms\Component\Element\Control\Select;
use Zingular\Forms\Component\Element\Control\Textarea;
use Zingular\Forms\Component\Element\ElementInterface;
use Zingular\Forms\View;

abstract class AbstractViewHandler implements ViewHandlerInterface
{
    /**
     * @param ComponentInterface $component
     * @return string
     */
    public function render(ComponentInterface $component)
    {
        if($component instanceof Container)
        {
            return $this->renderContainerType($component);
        }

        /** @var ElementInterface $element */
        $element = $component;

        return $this->renderElement($element);
    }

    /**
     * @param array $components
     * @return string
     */
    protected function renderComponents(array $components)
    {
        $buffer = '';

        /** @var ComponentInterface $component */
        foreach ($components as $component)
        {
            $buffer .= $this->render($component);
        }

        return $buffer;
    }

    /**
     * @param Container $container
     * @return string
     */
    protected function renderContainerType(Container $container)
    {
        if($container instanceof Form)
        {
            return $this->renderForm($container);
        }

        $view = $container->getViewName();

        switch($view)
        {
            case View::CONTAINER:return $this->renderContainer($container);
            case View::FIELD:return $this->renderField($container);
            case View::FIELDSET:return $this->renderFieldset($container);
            case View::TRANSPARENT:
            default:
            {
                return $this->renderTransparent($container);
            }
        }
    }

    /**
     * @param ElementInterface $element
     * @return string
     */
    protected function renderElement(ElementInterface $element)
    {
        if($element instanceof AbstractControl)
        {
            return $this->renderControl($element);
        }

        /** @var Content $content */
        $content = $element;

        return $this->renderContent($content);
    }

    /**
     * @param Content $content
     * @return string
     */
    protected function renderContent(Content $content)
    {
        if($content instanceof Label)
        {
            return $this->renderLabel($content);
        }
        elseif($content instanceof Html)
        {
            return $this->renderHtml($content);
        }
        elseif($content instanceof HtmlTag)
        {
            return $this->renderTag($content);
        }
        else
        {
            return '';
        }
    }

    /**
     * @param AbstractControl $control
     * @return string
     */
    protected function renderControl(AbstractControl $control)
    {
        if($control instanceof Checkbox)
        {
            return $this->renderCheckbox($control);
        }
        if($control instanceof Input)
        {
            return $this->renderInput($control);
        }
        elseif($control instanceof Select)
        {
            return $this->renderSelect($control);
        }
        elseif($control instanceof Button)
        {
            return $this->renderButton($control);
        }
        elseif($control instanceof Textarea)
        {
            return $this->renderTextarea($control);
        }

        return '';
    }

    /******************************************************************
     * RENDER CONTAINERS
     *****************************************************************/

    /**
     * @param Container $container
     * @return string
     */
    abstract protected function renderContainer(Container $container);

    /**
     * @param Container $container
     * @return string
     */
    abstract protected function renderFieldset(Container $container);

    /**
     * @param Container $container
     * @return string
     */
    abstract protected function renderField(Container $container);

    /**
     * @param Container $container
     * @return string
     */
    abstract protected function renderTransparent(Container $container);

    /**
     * @param Form $container
     * @return string
     */
    abstract protected function renderForm(Form $container);

    /******************************************************************
     * RENDER CONTROLS
     *****************************************************************/

    /**
     * @param Input $input
     * @return string
     */
    abstract protected function renderInput(Input $input);

    /**
     * @param Checkbox $input
     * @return string
     */
    abstract protected function renderCheckbox(Checkbox $input);

    /**
     * @param Select $select
     * @return string
     */
    abstract protected function renderSelect(Select $select);

    /**
     * @param Button $button
     * @return string
     */
    abstract protected function renderButton(Button $button);

    /**
     * @param Textarea $textarea
     * @return string
     */
    abstract protected function renderTextarea(Textarea $textarea);

    /******************************************************************
     * RENDER CONTENT
     *****************************************************************/

    /**
     * @param Label $label
     * @return string
     */
    abstract protected function renderLabel(Label $label);

    /**
     * @param Html $html
     * @return string
     */
    abstract protected function renderHtml(Html $html);

    /**
     * @param HtmlTag $tag
     * @return string
     */
    abstract protected function renderTag(HtmlTag $tag);
}