<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 2-2-2016
 * Time: 18:30
 */

namespace Zingular\Form\Service\Aggregation;
use Zingular\Form\Component\ConfigurableTrait;


/**
 * Class AbstractAggregator
 * @package Zingular\Form
 */
abstract class AbstractAggregator implements AggregatorInterface
{
    use ConfigurableTrait;
}