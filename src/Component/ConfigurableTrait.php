<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 2-2-2016
 * Time: 19:42
 */

namespace Zingular\Form\Component;
use Zingular\Form\Exception\FormException;

/**
 * Class ConfigurableTrait
 * @package Zingular\Form
 */
trait ConfigurableTrait
{
    /**
     * @var array
     */
    protected $options = array();

    /**
     * @var array
     */
    protected $defaultOptions = array();

    /**
     * @param array $options
     * @return mixed
     */
    public function setOptions(array $options = array())
    {
        $this->options = array_replace_recursive($this->options,$options);
    }

    /**
     * @param $option
     * @return mixed
     * @throws \Exception
     */
    protected function getOption($option)
    {
        if(array_key_exists($option,$this->options))
        {
            return $this->options[$option];
        }
        elseif(array_key_exists($option,$this->defaultOptions))
        {
            return $this->defaultOptions[$option];
        }

        throw new FormException(sprintf("Cannot retrieve option '%s' for Configurable class '%s': option not set and no default specified!",$option,get_called_class()));
    }
}