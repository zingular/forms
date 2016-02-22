<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 12-2-2016
 * Time: 15:44
 */

namespace Zingular\Form\Service\Builder;

use Zingular\Form\Component\Container\Container;
use Zingular\Form\Service\Bridge\Translation\TranslatorInterface;

interface ErrorBuilderInterface
{
    /**
     * @param Container $container
     * @param array $errors
     * @param TranslatorInterface $translator
     * @return mixed
     */
    public function build(Container $container,array $errors,TranslatorInterface $translator);
}