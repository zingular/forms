<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 16-2-2016
 * Time: 20:07
 */

namespace Zingular\Forms\Service\Evaluation;

/**
 * Class AbstractCallableEvaluator
 * @package Zingular\Form\Evaluation\Evaluator
 */
abstract class AbstractCallableEvaluator implements EvaluatorInterface
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
     * @param array $args
     * @return array
     */
    public function compileArgs(array $args = array())
    {
        $params = $this->params;
        $argsCount = count($args);
        $paramCount = count($params);

        if($argsCount < $paramCount)
        {
            $params = array_slice($params,0,$argsCount,false);
        }
        elseif($paramCount < $argsCount)
        {
            $args = array_slice($args,0,$paramCount,false);
        }

        return array_combine($params,$args);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}