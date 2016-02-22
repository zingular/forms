<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 16-2-2016
 * Time: 20:49
 */

namespace Zingular\Form\Service\Evaluation;

/**
 * Class EvaluatorConfigCollection
 * @package Zingular\Form\Evaluation
 */
class EvaluatorConfigCollection
{
    /**
     * @var array
     */
    protected $evaluators = array();

    /**
     * @param EvaluatorConfig $config
     */
    public function addEvaluator(EvaluatorConfig $config)
    {
        $this->evaluators[] = $config;
    }

    /**
     * @return array
     */
    public function getEvaluators()
    {
        return $this->evaluators;
    }
}