<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 11:02
 */

namespace Zingular\Form\Service\Condition;
use Zingular\Form\Component\ComponentInterface;
use Zingular\Form\Component\FormContext;

/**
 * Class ConditionGroup
 * @package Service\Condition
 */
class ConditionGroup
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var array
     */
    protected $conditions = array();

    /**
     * @param string $type
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * @param string $conditionType
     * @param array $args
     */
    public function add($conditionType,array $args = array())
    {
        $this->conditions[] = array($conditionType,$args);
    }

    public function isValid(ComponentInterface $source, FormContext $context)
    {
        // TODO: Implement isValid() method.
    }
}