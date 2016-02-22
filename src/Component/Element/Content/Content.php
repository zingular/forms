<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 2-2-2016
 * Time: 19:06
 */

namespace Zingular\Form\Component\Element\Content;
use Zingular\Form\BaseTypes;
use Zingular\Form\Component\ComponentInterface;
use Zingular\Form\Component\Element\AbstractElement;
use Zingular\Form\Component\FormContext;

/**
 * Class Content
 * @package Zingular\Form
 */
class Content extends AbstractElement implements ComponentInterface
{
    /**
     * @var string
     */
    protected $baseType = BaseTypes::CONTENT;

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