<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 9-2-2016
 * Time: 21:05
 */

namespace Zingular\Form\Component\Container;

use Zingular\Form\BaseTypes;
use Zingular\Form\Builder;
use Zingular\Form\View;

/**
 * Class Fieldset
 * @package Zingular\Form\Component\Container
 */
class Fieldset extends Container
{
    /**
     * @var string
     */
    protected $viewName = View::FIELDSET;

    /**
     * @var string
     */
    protected $preBuilder = Builder::FIELDSET;

    /**
     * @var string
     */
    protected $baseType = BaseTypes::FIELDSET;
}