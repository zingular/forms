<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 12-2-2016
 * Time: 16:48
 */

namespace Zingular\Forms\Plugins\Evaluators;


/**
 * Class CallableFilterType
 * @package Zingular\Form\Evaluation\Evaluator
 */
class CallableFilterType extends AbstractCallableEvaluatorType implements FilterTypeInterface
{
    /**
     * @param $value
     * @param array $args
     * @return mixed
     * @return mixed
     */
    public function filter($value,array $args = array())
    {
        array_unshift($args,$value);
        return call_user_func_array($this->callable,$args);
    }
}