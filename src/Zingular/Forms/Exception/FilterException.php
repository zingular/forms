<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 14-3-2016
 * Time: 19:57
 */

namespace Zingular\Forms\Exception;

/**
 * Class FilterException
 * @package Zingular\Forms\Exception
 */
class FilterException extends AbstractEvaluationException
{
    /**
     * ValidatorException constructor.
     * @param string $message
     * @param string $type
     * @param array $params
     */
    public function __construct($type, array $params = array(),$message = '')
    {
        parent::__construct('filter.'.$type, $params,$message);
    }
}