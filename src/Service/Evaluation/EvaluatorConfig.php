<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 16-2-2016
 * Time: 20:31
 */

namespace Zingular\Form\Service\Evaluation;

/**
 * Class EvaluatorConfig
 * @package Zingular\Form\Evaluation
 */
abstract class EvaluatorConfig
{
    /**
     * @var callable|string
     */
    protected $evaluator;

    /**
     * @var array
     */
    protected $args;

    /**
     * @param $evaluator
     * @param array $args
     */
    public function __construct($evaluator,array $args = array())
    {
        $this->evaluator = $evaluator;
        $this->args = $args;
    }

    /**
     * @return callable|string
     */
    public function getEvaluator()
    {
        return $this->evaluator;
    }

    /**
     * @return array
     */
    public function getArgs()
    {
        return $this->args;
    }
}