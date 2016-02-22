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
 * Class Field
 * @package Zingular\Form\Component\Container
 */
class Field extends Container
{
    /**
     * @var string
     */
    protected $viewName = View::FIELD;

    /**
     * @var string
     */
    protected $postBuilder = Builder::FIELD;

    /**
     * @var string
     */
    protected $baseType = BaseTypes::FIELD;
}