<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 15:14
 */

namespace Zingular\Forms\Exception;


/**
 * Class FormException
 * @package Zingular\Form\Exception
 */
class FormException extends \Exception
{
    const TYPE_GENERIC = 'generic';

    /**
     * @var string
     */
    protected $type;

    /**
     * @var array
     */
    protected $params;

    /**
     * @param string $message
     * @param string $type
     * @param array $params
     */
    public function __construct($message = '',$type = self::TYPE_GENERIC,array $params = array())
    {
        parent::__construct($message);
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