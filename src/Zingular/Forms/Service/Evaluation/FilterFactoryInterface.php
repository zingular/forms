<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 17-2-2016
 * Time: 20:00
 */

namespace Zingular\Forms\Service\Evaluation;
use Zingular\Forms\Plugins\Evaluators\FilterInterface;

/**
 * Interface FilterFactoryInterface
 * @package Zingular\Form\Service\Evaluation
 */
interface FilterFactoryInterface
{
    /**
     * @param string $name
     * @return FilterInterface
     */
    public function create($name);
}