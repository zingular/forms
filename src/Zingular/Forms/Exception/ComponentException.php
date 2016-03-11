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
     * @param array $type
     * @param array $params
     * @param string $message
     */
    public function __construct(ComponentInterface $component,$type,array $params = array(),$message = '')
    {
        parent::__construct($type,$params,$message);
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