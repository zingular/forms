<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 2-2-2016
 * Time: 19:21
 */

namespace Zingular\Form\Component\Element\Content;
use Zingular\Form\BaseTypes;
use Zingular\Form\Component\ComponentInterface;
use Zingular\Form\Component\Container\Container;
use Zingular\Form\Component\Element\Control\AbstractControl;

/**
 * Class Label
 * @package Zingular\Form
 */
class Label extends Content
{
    /**
     * @var string
     */
    protected $baseType = BaseTypes::LABEL;

    /**
     * @var string
     */
    protected $for;

    /**
     * @var string
     */
    protected $text;

    /**
     * @param string|ComponentInterface $for
     * @return $this
     */
    public function setFor($for = null)
    {
        if($for instanceof ComponentInterface)
        {
            if($for instanceof AbstractControl)
            {
                $for = $for->getFullId();
            }
            elseif($for instanceof Container)
            {
                return $this->setFor($for->getFirstControl());
            }
            else
            {
                $for = null;
            }
        }

        $this->for = $for;
        return $this;
    }

    /**
     * @return string
     */
    public function getFor()
    {
        return $this->for;
    }

    /**
     * @return string
     */
    public function getText()
    {
        if(is_null($this->text))
        {
            return $this->getId();
        }

        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }
}