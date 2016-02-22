<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 12-2-2016
 * Time: 13:50
 */

namespace Zingular\Forms\Exception;

class ValidationException extends FormException
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var array
     */
    protected $params;


    /**
     * @param string $type
     * @param array $params
     */
    public function __construct($type,array $params = array())
    {
        $this->type = $type;
        $this->params = $params;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }


}