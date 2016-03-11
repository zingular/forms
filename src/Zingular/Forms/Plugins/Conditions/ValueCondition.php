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
 * Class ValueCondition
 * @package Zingular\Forms\Plugins\Conditions
 */
class ValueCondition extends CallableCondition
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
        if($state->hasValue($inputName,$source->getParent()) === false)
        {
            return false;
        }

        $validator = $state->getServices()->getValidators()->get($validator);

        $sourceValue = $state->getValue($inputName,$source->getParent());

        return $validator->validate($sourceValue,$params);
    }

}