<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 23-2-2016
 * Time: 18:36
 */

namespace Zingular\Forms\Service\Condition;
use Zingular\Forms\Component\ComponentInterface;

/**
 * Class ConditionalConfig
 * @package Zingular\Forms\Service\Condition
 */
class ConditionalConfig
{
    /**
     * @var ComponentInterface
     */
    protected $subject;

    /**
     * @param ComponentInterface $subject
     * @param $conditionType
     * @param $args
     */
    public function __construct(ComponentInterface $subject,$conditionType,...$args)
    {
        $this->subject = $subject;
    }




}