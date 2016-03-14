<?php
/**
 * Created by PhpStorm.
 * User: michielleideman
 * Date: 14-03-16
 * Time: 13:41
 */

namespace Zingular\Forms\Plugins\Builders\Container;

/**
 * Class BuilderConfig
 * @package Zingular\Forms\Plugins\Builders\Container
 */
class BuilderConfig
{
    /**
     * @var string|BuilderInterface|RuntimeBuilderInterface|callable
     */
    protected $builderType;

    /**
     * @var array
     */
    protected $options;

    /**
     * BuilderConfig constructor.
     * @param $builderType
     * @param array $options
     */
    public function __construct($builderType,array $options = array())
    {
        $this->builderType = $builderType;
        $this->options = $options;
    }

    /**
     * @return array
     */
    public function getBuilderType()
    {
        return $this->options;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }
}