<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 16-3-2016
 * Time: 20:59
 */

namespace Zingular\Forms\Plugins\Evaluators;

/**
 * Interface EvaluatorTypeInterface
 * @package Zingular\Forms\Plugins\Evaluators
 */
interface EvaluatorTypeInterface extends EvaluatorInterface
{
    /**
     * @return string
     */
    public function getName();
}