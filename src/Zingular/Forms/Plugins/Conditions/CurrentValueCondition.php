<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 11:00
 */

namespace Zingular\Forms\Plugins\Conditions;

use Zingular\Forms\Component\ComponentInterface;
use Zingular\Forms\Component\DataUnitComponentInterface;
use Zingular\Forms\Component\FormState;
use Zingular\Forms\Validator;

/**
 * Class FieldValueCondition
 * @package Zingular\Forms\Plugins\Conditions
 */
class CurrentValueCondition extends CallableCondition
{
    /**
     *
     */
    public function __construct()
    {
        parent::__construct('currentValue',array($this,'evaluate'),true);
    }

    /**
     * @param ComponentInterface $source
     * @param FormState $state
     * @param string $validator
     * @param ...$params
     * @return bool
     */
    public function evaluate(ComponentInterface $source,FormState $state,$validator = Validator::HAS_VALUE,...$params)
    {
        //print_rf($source->getValue());

        // if it is not a data unit component, always return false
        if(!($source instanceof DataUnitComponentInterface))
        {
            return false;
        }

        // try to get the validator from the services
        $validator = $state->getServices()->getValidators()->get($validator);




        //print_rf($source->describe());
//exit;
        // return if the validator validates
        return $validator->validate($source->getValue(),$params);
    }

}