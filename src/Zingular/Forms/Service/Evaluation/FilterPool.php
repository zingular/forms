<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 16-2-2016
 * Time: 20:09
 */

namespace Zingular\Forms\Service\Evaluation;

/**
 * Class FilterPool
 * @package Zingular\Form\Evaluation\Evaluator
 */
class FilterPool
{
    /**
     * @var array
     */
    protected $filters = array();

    /**
     * @var FilterFactoryInterface
     */
    protected $factory;

    /**
     * @param FilterFactoryInterface $factory
     */
    public function __construct(FilterFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param FilterInterface $filter
     */
    public function add(FilterInterface $filter)
    {
        $this->filters[$filter->getName()] = $filter;
    }

    /**
     * @param string $name
     * @return ValidatorInterface
     */
    public function get($name)
    {
        if(isset($this->filters[$name]))
        {
            return $this->filters[$name];
        }
        else
        {
            $validator = $this->factory->create($name);
            $this->add($validator);
            return $validator;
        }
    }
}