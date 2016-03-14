<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 11-3-2016
 * Time: 20:25
 */

namespace Zingular\Forms\Exception;


use Zingular\Forms\Component\ComponentInterface;

/**
 * Class ComponentException
 * @package Zingular\Forms\Exception
 */
class ComponentException extends FormException
{
    /**
     * @var ComponentInterface
     */
    protected $component;

    /**
     * @param ComponentInterface $component
     * @param string $message
     * @param string $type
     * @param array $params
     */
    public function __construct(ComponentInterface $component,$message = '',$type = '',array $params = array())
    {
        parent::__construct($message,$type,$params);
        $this->component = $component;
    }

    /**
     * @return ComponentInterface
     */
    public function getComponent()
    {
        return $this->component;
    }
}