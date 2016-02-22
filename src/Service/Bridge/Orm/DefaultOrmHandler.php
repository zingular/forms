<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 9-2-2016
 * Time: 21:48
 */

namespace Zingular\Form\Service\Bridge\Orm;

/**
 * Class DefaultOrmHandler
 * @package Zingular\Form\Service\Bridge\Orm
 */
class DefaultOrmHandler implements OrmHandlerInterface
{
    /**
     * @param object $model
     * @return array
     */
    public function extractDefaultValues($model)
    {
        $values = get_object_vars($model);

        // TODO: use reflection to get public properties and public getter methods and extract their values

        return $values;
    }

    /**
     * @param array $values
     * @param object $model
     */
    public function setValues(array $values, $model)
    {
        $vars = get_object_vars($model);

        foreach($vars as $var=>$value)
        {
            if(array_key_exists($var,$values))
            {
                $model->$var = $values[$var];
            }
        }
    }
}