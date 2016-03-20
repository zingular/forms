<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 5-2-2016
 * Time: 20:28
 */

namespace Zingular\Forms\Service\Bridge\View;


use Zingular\Forms\Component\ViewableComponentInterface;

/**
 * Class TwigViewHandler
 * @package Zingular\Form\Service\View
 */
class TwigViewHandler implements ViewHandlerInterface
{
    /**
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * @param \Twig_Environment $twig
     */
    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param ViewableComponentInterface $component
     * @return string
     */
    public function render(ViewableComponentInterface $component)
    {
        $params = array('component'=>$component);
        return $this->twig->render($this->getTemplateNameFromView($component),$params);
    }

    /**
     * @param ViewableComponentInterface $component
     * @return string
     */
    protected function getTemplateNameFromView(ViewableComponentInterface $component)
    {
        // TODO: map generic form view name to twig template
        return $component->getViewName().'.twig';
    }
}