<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 5-2-2016
 * Time: 17:57
 */

namespace Zingular\Form\Service\Bridge\View;
use Zingular\Form\Component\ComponentInterface;
use Zingular\Form\Service\Bridge\Translation\TranslatorInterface;

/**
 * Interface ViewHandlerInterface
 * @package Zingular\Form
 */
interface ViewHandlerInterface
{
    /**
     * @param ComponentInterface $component
     * @param TranslatorInterface $translator
     * @return string
     */
    public function render(ComponentInterface $component,TranslatorInterface $translator);
}