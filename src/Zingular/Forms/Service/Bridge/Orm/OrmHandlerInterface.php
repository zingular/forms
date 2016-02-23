<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 29-1-2016
 * Time: 9:57
 */

namespace Zingular\Forms\Service\Bridge\Orm;

/**
 * Interface OrmHandlerInterface
 * @package Zingular\Form\Service\Bridge\Orm
 */
interface OrmHandlerInterface
{
    /**
     * @param object $model
     * @return array
     */
    public function extractValues($model);

    /**
     * @param array $values
     * @param object $model
     */
    public function setValues(array $values,$model);
}