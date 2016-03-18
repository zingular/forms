<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 11-2-2016
 * Time: 21:13
 */

namespace Zingular\Forms\Plugins\Builders\Options;

use Zingular\Forms\Exception\FormException;
use Zingular\Forms\OptionMode;

/**
 * Class OptionsProvider
 * @package Zingular\Form\Component
 */
class OptionsProvider
{
    /**
     * @var callable
     */
    protected $callback;

    /**
     * @var array
     */
    protected $rawOptions;

    /**
     * @var array
     */
    protected $options;

    /**
     * @var string
     */
    protected $mode;

    /**
     * @param array|callable $options
     * @param string $mode
     * @throws FormException
     */
    public function __construct($options,$mode = OptionMode::MODE_KEYS_VALUES)
    {
        if(is_callable($options))
        {
            $this->callback = $options;
        }
        elseif(is_array($options))
        {
            $this->rawOptions = $options;
        }
        else
        {
            throw new FormException(sprintf("Cannot create options collection: invalid options provider type '%s'",gettype($options)));
        }

        $this->mode = $mode;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        if(is_null($this->options))
        {
            if(is_null($this->rawOptions))
            {
                $this->rawOptions = call_user_func($this->callback);
            }


            return array();
            //
            foreach($this->rawOptions as $key=>$value)
            {

            }
        }

        return $this->options;
    }
}