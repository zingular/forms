<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 12-2-2016
 * Time: 15:44
 */

namespace Zingular\Forms\Service\Builder;

use Zingular\Forms\Component\Container\Container;
use Zingular\Forms\Service\Bridge\Translation\TranslatorInterface;

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