<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 11-2-2016
 * Time: 21:17
 */

namespace Zingular\Forms\Component\Elements\Controls;

/**
 * Class OptionGroup
 * @package Zingular\Form\Component\Element\Control
 */
class OptionGroup
{
    /**
     * @var array
     */
    protected $options = array();

    /**
     * @var string
     */
    protected $key;

    /**
     * @param $key
     */
    public function __construct($key)
    {
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->key;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param Option $option
     */
    public function addOption(Option $option)
    {
        $this->options[] = $option;
    }
}