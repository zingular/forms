<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 12-3-2016
 * Time: 12:32
 */

namespace Zingular\Forms\Plugins\Converters;

/**
 * Class InternalCallableConverter
 * @package Zingular\Forms\Plugins
 */
class InternalCallableConverter extends CallableConverterType
{
    /**
     * @param string $name
     * @param object $object
     */
    public function __construct($name,$object)
    {
        parent::__construct($name,array($object,$name.'_encode'),array($object,$name.'_decode'));
    }
}