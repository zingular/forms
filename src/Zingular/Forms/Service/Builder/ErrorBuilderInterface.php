<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 12-2-2016
 * Time: 15:44
 */

namespace Zingular\Forms\Service\Builder;

use Zingular\Forms\Component\Container\Container;
use Zingular\Forms\Component\FormContext;
use Zingular\Forms\Service\Bridge\Translation\TranslatorInterface;

interface ErrorBuilderInterface
{
    /**
     * @param Container $container
     * @param FormContext $context
     * @param array $errors
     * @param TranslatorInterface $translator
     */
    public function build(Container $container,FormContext $context,array $errors,TranslatorInterface $translator);
}