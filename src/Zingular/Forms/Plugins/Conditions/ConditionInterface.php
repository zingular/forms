<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 10:59
 */

namespace Zingular\Forms\Plugins\Conditions;


use Zingular\Forms\Component\ComponentInterface;
use Zingular\Forms\Component\State;

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
     * @param State $context
     * @return mixed
     */
    public function isValid(ComponentInterface $source, array $params = array(),State $context);
}