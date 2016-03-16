<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 12-2-2016
 * Time: 13:50
 */

namespace Zingular\Forms\Exception;

/**
 * Class ValidatorException
 * @package Zingular\Forms\Exception
 */
class ValidatorException extends AbstractEvaluationException
{
    /**
     * ValidatorException constructor.
     * @param string $message
     * @param string $type
     * @param array $params
     */
    public function __construct($type, array $params,$message = '')
    {
        parent::__construct('validator.'.$type, $params,$message);
    }
}