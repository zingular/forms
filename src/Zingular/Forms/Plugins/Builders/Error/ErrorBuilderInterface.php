<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 12-2-2016
 * Time: 15:44
 */

namespace Zingular\Forms\Plugins\Builders\Error;

use Zingular\Forms\Component\Container\BuildableInterface;
use Zingular\Forms\Component\FormState;

/**
 * Interface ErrorBuilderInterface
 * @package Zingular\Forms\Plugins\Builders\Error
 */
interface ErrorBuilderInterface
{
    /**
     * @param BuildableInterface $container
     * @param FormState $context
     * @param array $errors
     */
    public function build(BuildableInterface $container,FormState $context,array $errors);
}