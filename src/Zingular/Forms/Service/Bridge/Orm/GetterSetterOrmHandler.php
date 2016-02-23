<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 23-2-2016
 * Time: 17:32
 */

namespace Zingular\Forms\Service\Bridge\Orm;
use ReflectionMethod;

/**
 * Class GetterSetterOrmHandler
 * @package Zingular\Forms\Service\Bridge\Orm
 */
class GetterSetterOrmHandler implements OrmHandlerInterface
{
    /**
     * @param object $model
     * @return array
     */
    public function extractValues($model)
    {
        $reflectionClass = new \ReflectionClass($model);

        $methods = $reflectionClass->getMethods(ReflectionMethod::IS_PUBLIC);

        $values = array();


        /** @var ReflectionMethod $method */
        foreach($methods as $method)
        {
            $name = $method->getName();

            if(strpos($name,'get') === 0)
            {
                $propertyName = lcfirst(substr($name,3));
                $values[$propertyName] = call_user_func(array($model,$name));
            }
        }

        return $values;
    }

    /**
     * @param array $values
     * @param object $model
     */
    public function setValues(array $values, $model)
    {
        foreach($values as $key=>$value)
        {
            $method = $this->getSetterNameFromFieldName($key);

            if(method_exists($model,$method))
            {
                call_user_func(array($model,$method),$value);
            }
        }
    }

    /**
     * @param $fieldname
     * @return string
     */
    protected function getSetterNameFromFieldName($fieldname)
    {
        return 'set'.ucfirst($fieldname);
    }
}