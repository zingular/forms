<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 16-2-2016
 * Time: 20:10
 */

namespace Zingular\Forms\Service\Evaluation;
use Zingular\Forms\Plugins\Evaluators\ValidatorTypeInterface;

/**
 * Class ValidatorPool
 * @package Zingular\Form\Evaluation\Evaluator
 */
class ValidatorPool
{
    /**
     * @var array
     */
    protected $validators = array();

    /**
     * @var ValidatorFactoryInterface
     */
    protected $factory;

    /**
     * @param ValidatorFactoryInterface $factory
     */
    public function __construct(ValidatorFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param ValidatorTypeInterface $validator
     */
    public function add(ValidatorTypeInterface $validator)
    {
        $this->validators[$validator->getName()] = $validator;
    }

    /**
     * @param string $name
     * @return ValidatorTypeInterface
     */
    public function get($name)
    {
        if(isset($this->validators[$name]))
        {
            return $this->validators[$name];
        }
        else
        {
            $validator = $this->factory->create($name);
            $this->validators[$name] = $validator;
            return $validator;
        }
    }
}