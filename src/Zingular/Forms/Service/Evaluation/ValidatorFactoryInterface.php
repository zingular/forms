<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 17-2-2016
 * Time: 20:00
 */

namespace Zingular\Forms\Service\Evaluation;

/**
 * Interface ValidatorFactoryInterface
 * @package Zingular\Form\Service\Evaluation
 */
interface ValidatorFactoryInterface
{
    /**
     * @param $name
     * @return ValidatorInterface
     */
    public function create($name);

    /**
     * @param string $name
     * @return bool
     */
    public function has($name);
}