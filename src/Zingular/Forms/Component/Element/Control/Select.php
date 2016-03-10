<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 30-1-2016
 * Time: 14:49
 */

namespace Zingular\Forms\Component\Element\Control;

use Zingular\Forms\Component\OptionsProvider;
use Zingular\Forms\OptionMode;

/**
 * Class Select
 * @package Zingular\Forms\Component\Element\Control
 */
class Select extends AbstractControl
{
    /**
     * @var OptionsProvider
     */
    protected $optionsProvider;

    /**
     * @var array
     */
    protected $compiledOptions;

    /**
     * @param callable|array $options
     * @param string $mode
     * @return $this
     */
    public function setOptions($options,$mode = OptionMode::MODE_KEYS_VALUES)
    {
        $this->optionsProvider = new OptionsProvider($options,$mode);
        return $this;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        if(is_null($this->compiledOptions))
        {
            if(is_null($this->optionsProvider))
            {
                return $this->compiledOptions = array();
            }

            $this->compiledOptions = $this->optionsProvider->getOptions();
        }

        return $this->compiledOptions;
    }
}