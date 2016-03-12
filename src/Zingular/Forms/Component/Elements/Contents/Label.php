<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 2-2-2016
 * Time: 19:21
 */

namespace Zingular\Forms\Component\Elements\Contents;

use Zingular\Forms\Component\ComponentInterface;
use Zingular\Forms\Component\Containers\Container;
use Zingular\Forms\Component\Elements\Controls\AbstractControl;

/**
 * Class Label
 * @package Zingular\Form
 */
class Label extends Content
{
    /**
     * @var string
     */
    protected $for;

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
}