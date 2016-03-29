<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 29-3-2016
 * Time: 20:56
 */

namespace Zingular\Forms\Component;
use Zingular\Forms\Service\Evaluation\FilterConfig;
use Zingular\Forms\Service\Evaluation\ValidatorConfig;

/**
 * Class EvaluatableTrait
 * @package Zingular\Forms\Component
 */
trait EvaluatableTrait
{
    /**
     * @var array
     */
    protected $evaluators = array();

    /**
     * @param callable|string $filter
     * @param ...$args
     * @return $this
     */
    public function addFilter($filter,...$args)
    {
        $this->evaluators[] = new FilterConfig($filter,$args);
        return $this;
    }

    /**
     * @param callable|string
     * @param ...$args
     * @return $this
     */
    public function addValidator($validator,...$args)
    {
        $this->evaluators[] = new ValidatorConfig($validator,$args);
        return $this;
    }

    /**
     * @return array
     */
    public function getEvaluators()
    {
        return $this->evaluators;
    }
}