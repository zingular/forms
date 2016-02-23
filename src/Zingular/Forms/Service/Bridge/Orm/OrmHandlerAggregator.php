<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 23-2-2016
 * Time: 16:03
 */

namespace Zingular\Forms\Service\Bridge\Orm;
use Zingular\Forms\Exception\FormException;

/**
 * Class OrmHandlerAggregator
 * @package Zingular\Forms\Service\Bridge\Orm
 */
class OrmHandlerAggregator implements OrmHandlerInterface
{
    /**
     * @var array
     */
    protected $handlers = array();

    /**
     * @param OrmHandlerInterface $handler
     * @param $checkCallable
     */
    public function addHandler(OrmHandlerInterface $handler,$checkCallable)
    {
        $this->handlers[] = array('checker'=>$checkCallable,'handler'=>$handler);
    }

    /**
     * @param $model
     * @return OrmHandlerInterface
     * @throws FormException
     */
    protected function getHandlerForModel($model)
    {
        foreach($this->handlers as $handlerData)
        {
            if(call_user_func($handlerData['checker'],$model))
            {
                return $handlerData['handler'];
            }
        }

        throw new FormException("Cannot get ORM-handler for model: no valid handler found!");
    }

    /**
     * @param object $model
     * @return array
     */
    public function extractValues($model)
    {
        return $this->getHandlerForModel($model)->extractValues($model);
    }

    /**
     * @param array $values
     * @param object $model
     */
    public function setValues(array $values, $model)
    {
        return $this->getHandlerForModel($model)->setValues($values,$model);
    }
}