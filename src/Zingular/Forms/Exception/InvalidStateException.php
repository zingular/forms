<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 18-3-2016
 * Time: 22:11
 */

namespace Zingular\Forms\Exception;

/**
 * Class InvalidStateException
 * @package Zingular\Forms\Exception
 */
class InvalidStateException extends FormException
{
    /**
     * @param string $message
     * @param string $type
     * @param array $params
     */
    public function __construct($message = '',$type = self::TYPE_GENERIC,array $params = array())
    {
        parent::__construct($message,'invalidState.'.$type,$params);
    }
}