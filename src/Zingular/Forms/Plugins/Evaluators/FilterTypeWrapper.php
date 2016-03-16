<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 15-3-2016
 * Time: 22:42
 */

namespace Zingular\Forms\Plugins\Evaluators;

/**
 * Class FilterTypeWrapper
 * @package Zingular\Forms\Plugins\Evaluators
 */
class FilterTypeWrapper implements FilterTypeInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var FilterInterface
     */
    protected $filter;

    /**
     * @param $name
     * @param FilterInterface $filter
     */
    public function __construct($name,FilterInterface $filter)
    {
        $this->name = $name;
        $this->filter = $filter;
    }

    /**
     * @param mixed $value
     * @param array $args
     * @return mixed
     */
    public function filter($value, array $args = array())
    {
        return $this->filter->filter($value,$args);
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->filter->getParams();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}