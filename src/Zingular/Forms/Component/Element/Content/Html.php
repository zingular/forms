<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 2-2-2016
 * Time: 19:49
 */

namespace Zingular\Forms\Component\Element\Content;
use Zingular\Forms\BaseTypes;

/**
 * Class Html
 * @package Zingular\Form
 */
class Html extends Content
{
    /**
     * @var string
     */
    protected $baseType = BaseTypes::HTML;

    /**
     * @var string
     */
    protected $html = '';

    /**
     * @param $html
     */
    public function setContent($html)
    {
        $this->html = $html;
    }
}