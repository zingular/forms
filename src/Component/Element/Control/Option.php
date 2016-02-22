<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 11-2-2016
 * Time: 21:17
 */

namespace Zingular\Form\Component\Element\Control;


class Option
{
    /**
     * @var mixed
     */
    protected $value;

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->getValue();
    }
}