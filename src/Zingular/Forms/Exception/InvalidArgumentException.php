<?php
/**
 * Created by PhpStorm.
 * User: michielleideman
 * Date: 16-03-16
 * Time: 08:42
 */

namespace Zingular\Forms\Exception;

/**
 * Class InvalidArgumentException
 * @package Zingular\Forms\Exception
 */
class InvalidArgumentException extends FormException
{
    /**
     * InvalidArgumentException constructor.
     * @param string $method
     * @param string $param
     * @param string $message
     */
    public function __construct($method,$param,$message = '')
    {
        parent::__construct($message, $type = 'invalidArgument', array('method'=>$method,'param'=>$param));
    }
}