<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 16-2-2016
 * Time: 20:03
 */

namespace Zingular\Forms\Service\Evaluation;

/**
 * Interface ValidatorInterface
 * @package Zingular\Form\Evaluation
 */
interface ValidatorInterface extends EvaluatorInterface
{
    /**
     * @param mixed $value
     * @param array $args
     * @return mixed
     */
    public function validate($value,array $args = array());
}