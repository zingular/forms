<?php

namespace Zingular\Forms\Service\Conversion;

/**
 * Class ConverterConfig
 * @package Zingular\Forms\Service\Conversion
 */
class ConverterConfig
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var array
     */
    protected $args;

    /**
     * @param $type
     * @param array $args
     */
    public function __construct($type,array $args = array())
    {
        $this->type = $type;
        $this->args = $args;
    }

    /**
     * @return callable|string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function getArgs()
    {
        return $this->args;
    }
}