<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 16-2-2016
 * Time: 21:00
 */

namespace Zingular\Forms\Service\Evaluation;

use Zingular\Forms\Exception\FormException;
use Zingular\Forms\Exception\ValidationException;
use Zingular\Forms\Validator;

/**
 * Class ValidatorFactory
 * @package Zingular\Form\Service\Evaluation
 */
class ValidatorFactory implements ValidatorFactoryInterface
{
    /**
     * @var array
     */
    protected $types = array
    (
        Validator::REGEX,
        Validator::MIN_LENGTH,
        Validator::MAX_LENGTH,
        Validator::MIN_VALUE,
        Validator::MAX_VALUE
    );

    /**
     * @param string $name
     * @return bool
     */
    public function has($name)
    {
        return in_array($name,$this->types);
    }

    /**
     * @param $name
     * @return ValidatorInterface
     * @throws FormException
     */
    public function create($name)
    {
        switch($name)
        {
            case Validator::REGEX: return new CallableValidator($name,array($this,$name),array('regex'));
            case Validator::MIN_LENGTH: return new CallableValidator($name,array($this,$name),array('min'));
            case Validator::MAX_LENGTH:return new CallableValidator($name,array($this,$name),array('max'));
            case Validator::MIN_VALUE: return new CallableValidator($name,array($this,$name),array('min'));
            case Validator::MAX_VALUE: return new CallableValidator($name,array($this,$name),array('max'));
            default: throw new FormException(sprintf("Cannot create validator: unknown validator type '%s'",$name));
        }
    }

    /**
     * @param $value
     * @param $format
     * @return bool
     * @throws ValidationException
     */
    public function regex($value,$format)
    {
        $res = @preg_match($format,$value);

        if($res === false)
        {
            throw new ValidationException('invalidRegex',array('regex'=>$format));
        }

        return $res === 1;
    }

    /**
     * @param $value
     * @param int $minLength
     * @return bool
     */
    public function minLength($value,$minLength = 1)
    {
        return mb_strlen($value) >= $minLength;
    }

    /**
     * @param $value
     * @param int $maxLength
     * @return bool
     */
    public function maxLength($value,$maxLength = 10)
    {
        return mb_strlen($value) <= $maxLength;
    }

    /**
     * @param $value
     * @param int $minValue
     * @return bool
     */
    public function minValue($value,$minValue = 0)
    {
        return (int) $value >= $minValue;
    }

    /**
     * @param $value
     * @param int $maxValue
     * @return bool
     */
    public function maxValue($value,$maxValue = 10)
    {
        return (int) $value <= $maxValue;
    }
}