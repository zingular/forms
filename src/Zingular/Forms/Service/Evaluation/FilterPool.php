<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 16-2-2016
 * Time: 20:09
 */

namespace Zingular\Forms\Service\Evaluation;
use Zingular\Forms\Plugins\Evaluators\FilterInterface;
use Zingular\Forms\Plugins\Evaluators\FilterTypeInterface;


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
     * @param FilterTypeInterface $filter
     */
    public function add(FilterTypeInterface $filter)
    {
        $this->filters[$filter->getName()] = $filter;
    }

    /**
     * @param string $name
     * @return FilterInterface
     */
    public function get($name)
    {
        if(isset($this->filters[$name]))
        {
            return $this->filters[$name];
        }
        else
        {
            $filter = $this->factory->create($name);
            $this->filters[$name] = $filter;
            return $filter;
        }
    }
}