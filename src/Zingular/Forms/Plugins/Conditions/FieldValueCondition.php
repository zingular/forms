<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 11:00
 */

namespace Zingular\Forms\Plugins\Conditions;

use Zingular\Forms\Component\ComponentInterface;
use Zingular\Forms\Component\FormState;
use Zingular\Forms\Validator;

/**
 * Class FieldValueCondition
 * @package Zingular\Forms\Plugins\Conditions
 */
class FieldValueCondition extends CallableCondition
{
    /**
     *
     */
    public function __construct()
    {
        parent::__construct('value',array($this,'validate'),true);
    }

    /**
     * @param ComponentInterface $source
     * @param FormState $state
     * @param $inputName
     * @param string $validator
     * @param ...$params
     * @return bool
     */
    public function validate(ComponentInterface $source,FormState $state,$inputName,$validator = Validator::HAS_VALUE,...$params)
    {
        // if the input has no value (NULL), always return false
        if($state->hasValue($inputName,$source->getParent()) === false)
        {
            return false;
        }

        // try to get the validator from the services
        $validator = $state->getServices()->getValidators()->get($validator);

        // get the current value for the target component
        $sourceValue = $state->getValue($inputName,$source->getParent());

        // return if the validator validates
        return $validator->validate($sourceValue,$params);
    }

}