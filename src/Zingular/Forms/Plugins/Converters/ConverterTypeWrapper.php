<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 15-3-2016
 * Time: 22:41
 */

namespace Zingular\Forms\Plugins\Converters;

/**
 * Class ConverterTypeWrapper
 * @package Zingular\Forms\Plugins\Converters
 */
class ConverterTypeWrapper implements ConverterTypeInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var ConverterInterface
     */
    protected $converter;

    /**
     * @param $name
     * @param ConverterInterface $converter
     */
    public function __construct($name,ConverterInterface $converter)
    {
        $this->name = $name;
        $this->converter = $converter;
    }

    /**
     * @param mixed $value
     * @param array $params
     * @return mixed
     */
    public function encode($value, array $params = array())
    {
        return $this->converter->encode($value,$params);
    }

    /**
     * @param mixed $value
     * @param array $params
     * @return mixed
     */
    public function decode($value, array $params = array())
    {
        return $this->converter->decode($value,$params);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}