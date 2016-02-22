<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 2-2-2016
 * Time: 19:49
 */

namespace Zingular\Form\Component\Element\Content;
use Zingular\Form\BaseTypes;

/**
 * Class View
 * @package Zingular\Form
 */
class View extends Content
{
    /**
     * @var string
     */
    protected $baseType = BaseTypes::VIEW;

    /**
     * @var string
     */
    protected $view = '';

    /**
     * @var array
     */
    protected $params = array();

    /**
     * @param $name
     * @param array $params
     * @return $this
     */
    public function setView($name,array $params = array())
    {
        $this->view = $name;
        $this->params = $params;
        return $this;
    }
}