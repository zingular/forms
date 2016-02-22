<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 16-2-2016
 * Time: 19:49
 */

namespace Zingular\Forms\Exception;


use Zingular\Forms\Component\ComponentInterface;
use Zingular\Forms\Component\DataUnitInterface;

/**
 * Class EvaluationException
 * @package Zingular\Form\Exception
 */
class EvaluationException extends ValidationException
{
    /**
     * @var ComponentInterface
     */
    protected $component;

    /**
     * @param DataUnitInterface $component
     * @param array $type
     * @param array $params
     */
    public function __construct(DataUnitInterface $component,$type,array $params = array())
    {
        parent::__construct($type,$params);
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