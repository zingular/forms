<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 2-2-2016
 * Time: 18:30
 */

namespace Zingular\Forms\Service\Aggregation;
use Zingular\Forms\Component\ConfigurableTrait;


/**
 * Class AbstractAggregator
 * @package Zingular\Form
 */
abstract class AbstractAggregator implements AggregatorInterface
{
    use ConfigurableTrait;
}