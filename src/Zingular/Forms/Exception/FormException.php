<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 15:14
 */

namespace Zingular\Forms\Exception;
use Zingular\Forms\Service\Bridge\Translation\TranslatorInterface;

/**
 * Class FormException
 * @package Zingular\Form\Exception
 */
class FormException extends \Exception
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
     * @param string $message
     */
    public function __construct($type,array $params = array(),$message = '')
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