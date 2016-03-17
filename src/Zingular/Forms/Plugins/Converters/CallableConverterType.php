<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 12-3-2016
 * Time: 12:25
 */

namespace Zingular\Forms\Plugins\Converters;

/**
 * Class CallableConverterType
 * @package Zingular\Forms\Plugins
 */
class CallableConverterType extends CallableConverter implements ConverterTypeInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @param string $name
     * @param callable $encodeCallback
     * @param callable $decodeCallback
     */
    public function __construct($name,$encodeCallback,$decodeCallback)
    {
        parent::__construct($encodeCallback,$decodeCallback);
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