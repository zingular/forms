<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 12-2-2016
 * Time: 16:48
 */

namespace Zingular\Form\Service\Evaluation;

/**
 * Class CallableValidator
 * @package Zingular\Form\Evaluation\Evaluator
 */
class CallableValidator extends AbstractCallableEvaluator implements ValidatorInterface
{
    /**
     * @param mixed $value
     * @param array $args
     * @return mixed
     */
    public function validate($value, array $args = array())
    {
        array_unshift($args,$value);
        return call_user_func_array($this->callable,$args);
    }
}