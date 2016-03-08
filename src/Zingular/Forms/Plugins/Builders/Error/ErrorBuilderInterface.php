<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 12-2-2016
 * Time: 15:44
 */

namespace Zingular\Forms\Plugins\Builders\Error;

use Zingular\Forms\Component\Container\BuildableInterface;
use Zingular\Forms\Component\FormContext;
use Zingular\Forms\Service\Bridge\Translation\TranslatorInterface;

/**
 * Interface ErrorBuilderInterface
 * @package Zingular\Forms\Plugins\Builders\Error
 */
interface ErrorBuilderInterface
{
    /**
     * @param BuildableInterface $container
     * @param FormContext $context
     * @param array $errors
     * @param TranslatorInterface $translator
     */
    public function build(BuildableInterface $container,FormContext $context,array $errors,TranslatorInterface $translator);
}