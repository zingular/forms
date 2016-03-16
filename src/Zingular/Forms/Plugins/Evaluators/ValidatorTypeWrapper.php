<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 15-3-2016
 * Time: 22:42
 */

namespace Zingular\Forms\Plugins\Evaluators;

/**
 * Class ValidatorTypeWrapper
 * @package Zingular\Forms\Plugins\Evaluators
 */
class ValidatorTypeWrapper implements ValidatorTypeInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * @param $name
     * @param ValidatorInterface $validator
     */
    public function __construct($name,ValidatorInterface $validator)
    {
        $this->name = $name;
        $this->validator = $validator;
    }

    /**
     * @param mixed $value
     * @param array $args
     * @return bool
     */
    public function validate($value, array $args = array())
    {
        return $this->validator->validate($value,$args);
    }

    /**
     * @return array
     */
    public function getParams()
    {
       return $this->validator->getParams();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}