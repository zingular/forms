<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 15-3-2016
 * Time: 22:14
 */

namespace Zingular\Forms\Plugins\Conditions;

/**
 * Interface ConditionTypeInterface
 * @package Zingular\Forms\Plugins\Conditions
 */
interface ConditionTypeInterface extends ConditionInterface
{
    /**
     * @return string
     */
    public function getName();
}