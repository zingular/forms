<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 16-2-2016
 * Time: 19:49
 */

namespace Zingular\Forms\Exception;

/**
 * Class AbstractEvaluationException
 * @package Zingular\Form\Exception
 */
abstract class AbstractEvaluationException extends FormException
{
    /**
     * @param string $type
     * @param array $params
     */
    public function __construct($type = self::TYPE_GENERIC,array $params = array())
    {
        parent::__construct('',$type,$params);
    }
}