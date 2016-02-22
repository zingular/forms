<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 5-2-2016
 * Time: 20:28
 */

namespace Zingular\Forms\Service\Bridge\View;

use Zingular\Forms\Component\ComponentInterface;
use Zingular\Forms\Service\Bridge\Translation\TranslatorInterface;

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
     * @param ComponentInterface $component
     * @param TranslatorInterface $translator
     * @return string
     */
    public function render(ComponentInterface $component, TranslatorInterface $translator)
    {
        $params = array('component'=>$component);
        return $this->twig->render($this->getTemplateNameFromView($component),$params);
    }

    /**
     * @param ComponentInterface $component
     * @return string
     */
    protected function getTemplateNameFromView(ComponentInterface $component)
    {
        // TODO: map generic form view name to twig template
        return $component->getViewName().'.twig';
    }
}