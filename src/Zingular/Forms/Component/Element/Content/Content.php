<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 2-2-2016
 * Time: 19:06
 */

namespace Zingular\Forms\Component\Element\Content;
use Zingular\Forms\BaseTypes;
use Zingular\Forms\Component\ComponentInterface;
use Zingular\Forms\Component\Element\AbstractElement;
use Zingular\Forms\Component\FormContext;

/**
 * Class Content
 * @package Zingular\Form
 */
class Content extends AbstractElement implements ComponentInterface
{
    /**
     *
     */
    public function describe()
    {
        return array
        (
            'name'=>$this->getId(),
            'fullName'=>$this->getFullId(),
            'type'=>get_class($this)
        );
    }

    /**
     * @param FormContext $formContext
     * @param array $defaultValues
     * @return string
     */
    public function compile(FormContext $formContext,array $defaultValues = array())
    {
        $this->formContext = $formContext;
    }
}