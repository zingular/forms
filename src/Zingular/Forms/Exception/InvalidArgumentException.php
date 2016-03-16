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
     * @param string $message
     * @param string $type
     * @param array $args
     */
    public function __construct($message = '',$type = self::TYPE_GENERIC,array $args = array())
    {
        parent::__construct($message, 'invalidArgument.'.$type, $args);
    }
}