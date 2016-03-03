<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 12:13
 */

namespace Zingular\Forms\Service\Builder;

use Zingular\Forms\Component\Container\Container;
use Zingular\Forms\Component\FormContext;

/**
 * Interface RuntimeBuilderInterface
 * @package Service\Builder
 */
interface RuntimeBuilderInterface
{
    /**
     * @param Container $container
     * @param FormContext $context
     * @return
     */
    public function build(Container $container,FormContext $context);
}