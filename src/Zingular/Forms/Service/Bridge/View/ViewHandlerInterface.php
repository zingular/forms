<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 5-2-2016
 * Time: 17:57
 */

namespace Zingular\Forms\Service\Bridge\View;
use Zingular\Forms\Component\ViewableComponentInterface;

/**
 * Interface ViewHandlerInterface
 * @package Zingular\Form
 */
interface ViewHandlerInterface
{
    /**
     * @param ViewableComponentInterface $component
     * @return string
     */
    public function render(ViewableComponentInterface $component);
}