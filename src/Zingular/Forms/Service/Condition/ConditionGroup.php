<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 11:02
 */

namespace Zingular\Forms\Service\Condition;
use Zingular\Forms\Component\ComponentInterface;
use Zingular\Forms\Component\FormState;

/**
 * Class ConditionGroup
 * @package Service\ConditionGroup
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

    /**
     * @param ComponentInterface $source
     * @param FormState $context
     */
    public function isValid(ComponentInterface $source, FormState $context)
    {
        // TODO: Implement isValid() method.
    }
}