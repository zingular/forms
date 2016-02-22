<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 11:00
 */

namespace Zingular\Form\Service\Condition;


use Zingular\Form\Component\ComponentInterface;
use Zingular\Form\Component\FormContext;

class ValueCondition implements ConditionInterface
{


    /**
     * @param ComponentInterface $source
     * @param array $params
     * @param FormContext $context
     * @return mixed
     */
    public function isValid(ComponentInterface $source, array $params = array(),FormContext $context)
    {

    }

    /**
     * @return string
     */
    public function getName()
    {
        // TODO: Implement getName() method.
    }
}