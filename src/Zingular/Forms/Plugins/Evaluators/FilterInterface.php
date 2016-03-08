<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 16-2-2016
 * Time: 20:03
 */

namespace Zingular\Forms\Plugins\Evaluators;


/**
 * Interface FilterInterface
 * @package Zingular\Form\Evaluation\Evaluator
 */
interface FilterInterface extends EvaluatorInterface
{
    /**
     * @param mixed $value
     * @param array $args
     * @return mixed
     */
    public function filter($value,array $args = array());
}