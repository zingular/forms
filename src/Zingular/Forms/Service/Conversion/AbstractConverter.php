<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 24-2-2016
 * Time: 19:32
 */

namespace Zingular\Forms\Service\Conversion;

/**
 * Class AbstractConverter
 * @package Zingular\Forms\Service\Conversion
 */
abstract class AbstractConverter implements ConverterInterface
{
    /**
    * @var string
    */
    protected $name;

    /**
    * @param string $name
    */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
    * @return string
    */
    public function getName()
    {
        return $this->name;
    }
 }