<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 30-1-2016
 * Time: 14:49
 */

namespace Zingular\Forms\Component\Element\Control;

/**
 * Class Textarea
 * @package Zingular\Form\Component\Element\Control
 */
class Textarea extends AbstractControl
{
    /**
     * @param int $numberOfCols
     * @return $this
     */
    public function cols($numberOfCols = 50)
    {
        $this->setHtmlAttribute('cols',$numberOfCols);
        return $this;
    }

    /**
     * @param int $numberOfRows
     * @return $this
     */
    public function rows($numberOfRows = 8)
    {
        $this->setHtmlAttribute('rows',$numberOfRows);
        return $this;
    }
}