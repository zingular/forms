<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 11-2-2016
 * Time: 20:02
 */

namespace Zingular\Forms\Service\Bridge\View;


use Zingular\Forms\Component\Containers\ContainerInterface;
use Zingular\Forms\Component\Containers\Form;

use Zingular\Forms\Component\Elements\Contents\Content;
use Zingular\Forms\Component\Elements\Contents\ContentInterface;
use Zingular\Forms\Component\Elements\Contents\Html;
use Zingular\Forms\Component\Elements\Contents\HtmlTag;
use Zingular\Forms\Component\Elements\Contents\Label;
use Zingular\Forms\Component\Elements\Controls\AbstractControl;
use Zingular\Forms\Component\Elements\Controls\Button;
use Zingular\Forms\Component\Elements\Controls\Checkbox;
use Zingular\Forms\Component\Elements\Controls\Input;
use Zingular\Forms\Component\Elements\Controls\Select;
use Zingular\Forms\Component\Elements\Controls\Textarea;
use Zingular\Forms\Component\Elements\ElementInterface;
use Zingular\Forms\Component\ViewableComponentInterface;
use Zingular\Forms\View as ViewNames;
use Zingular\Forms\Component\Elements\Contents\View;

/**
 * Class AbstractViewHandler
 * @package Zingular\Forms\Service\Bridge\View
 */
abstract class AbstractViewHandler implements ViewHandlerInterface
{
    /**
     * @param ViewableComponentInterface $component
     * @return string
     */
    public function render(ViewableComponentInterface $component)
    {
        // render container
        if($component instanceof ContainerInterface)
        {
            return $this->renderContainerType($component);
        }
        // render element
        elseif($component instanceof ElementInterface)
        {
            return $this->renderElement($component);
        }
        // render generic component
        else
        {
            // TODO: find a way to render view of custom components that only implement the base interfaces
            return '';
        }
    }

    /**
     * @param array $components
     * @return string
     */
    protected function renderComponents(array $components)
    {
        $buffer = '';

        foreach ($components as $component)
        {
            if($component instanceof ViewableComponentInterface)
            {
                $buffer .= $this->render($component);
            }
        }

        return $buffer;
    }

    /**
     * @param ContainerInterface $container
     * @return string
     */
    protected function renderContainerType(ContainerInterface $container)
    {
        if($container instanceof Form)
        {
            return $this->renderForm($container);
        }

        if($container instanceof ViewableComponentInterface)
        {
            $view = $container->getViewName();

            /** @var ContainerInterface $cont */
            $cont = $container;

            switch($view)
            {
                case ViewNames::CONTAINER:return $this->renderContainer($cont);
                case ViewNames::FIELD:return $this->renderField($cont);
                case ViewNames::FIELDSET:return $this->renderFieldset($cont);
                case ViewNames::ROW:return $this->renderRow($cont);
            }
        }

        return $this->renderTransparent($container);
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

        return $this->renderContentType($content);
    }

    /**
     * @param ContentInterface $content
     * @return string
     */
    protected function renderContentType(ContentInterface $content)
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
        elseif($content instanceof View)
        {
            return $this->renderView($content);
        }
        else
        {
            return $this->renderContent($content);
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
     * @param ContainerInterface $container
     * @return string
     */
    abstract protected function renderContainer(ContainerInterface $container);

    /**
     * @param ContainerInterface $container
     * @return string
     */
    abstract protected function renderFieldset(ContainerInterface $container);

    /**
     * @param ContainerInterface $container
     * @return string
     */
    abstract protected function renderField(ContainerInterface $container);

    /**
     * @param ContainerInterface $container
     * @return string
     */
    abstract protected function renderRow(ContainerInterface $container);

    /**
     * @param ContainerInterface $container
     * @return string
     */
    abstract protected function renderTransparent(ContainerInterface $container);

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

    /**
     * @param ContentInterface $label
     * @return string
     */
    abstract protected function renderContent(ContentInterface $label);

    /**
     * @param View $view
     * @return mixed
     */
    abstract protected function renderView(View $view);
}