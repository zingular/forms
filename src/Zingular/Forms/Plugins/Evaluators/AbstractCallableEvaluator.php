<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 16-2-2016
 * Time: 20:07
 */

namespace Zingular\Forms\Plugins\Evaluators;

/**
 * Class AbstractCallableEvaluator
 * @package Zingular\Form\Evaluation\Evaluator
 */
abstract class AbstractCallableEvaluator implements EvaluatorTypeInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var callable
     */
    protected $callable;

    /**
     * @var array
     */
    protected $params;

    /**
     * @param string $name
     * @param callable $callable
     * @param array $params
     */
    public function __construct($name,$callable,array $params = array())
    {
        $this->name = $name;
        $this->callable = $callable;
        $this->params = $params;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}