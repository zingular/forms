<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 10:59
 */

namespace Zingular\Forms\Plugins\Conditions;


use Zingular\Forms\Component\ComponentInterface;
use Zingular\Forms\Component\FormState;

/**
 * Interface ConditionInterface
 * @package Zingular\Form\Service\ConditionGroup
 */
interface ConditionInterface
{
    /**
     * @param ComponentInterface $source
     * @param array $params
     * @param FormState $state
     * @return bool
     */
    public function isValid(ComponentInterface $source, FormState $state, array $params = array());
}