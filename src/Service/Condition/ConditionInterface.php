<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 10:59
 */

namespace Zingular\Form\Service\Condition;


use Zingular\Form\Component\ComponentInterface;
use Zingular\Form\Component\FormContext;

/**
 * Interface ConditionInterface
 * @package Zingular\Form\Service\Condition
 */
interface ConditionInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param ComponentInterface $source
     * @param array $params
     * @param FormContext $context
     * @return mixed
     */
    public function isValid(ComponentInterface $source, array $params = array(),FormContext $context);
}