<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 20:43
 */

namespace Zingular\Forms\Service\Condition;
use Zingular\Forms\Plugins\Conditions\ConditionInterface;


/**
 * Interface ConditionFactoryInterface
 * @package Zingular\Forms\Service\ConditionGroup
 */
interface ConditionFactoryInterface
{
    /**
     * @param string $type
     * @return ConditionInterface
     */
    public function create($type);
}