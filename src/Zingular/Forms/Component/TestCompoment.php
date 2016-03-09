<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 5-3-2016
 * Time: 16:13
 */

namespace Zingular\Forms\Component;
use Zingular\Forms\Component\Element\Content\ContentInterface;

/**
 * Class TestCompoment
 * @package Zingular\Forms\Component
 */
class TestCompoment implements CssComponentInterface,ContentInterface,ViewableComponentInterface
{
    use ComponentTrait;
    use ViewSetterTrait;
    use CssTrait;
    // TODO: find a way to render view of custom components that only implement the base interfaces

    /**
     * @param FormContext $formContext
     */
    public function compile(FormContext $formContext)
    {
        // TODO: Implement compile() method.
    }

    /**
     * @return array
     */
    public function describe()
    {
        // TODO: Implement describe() method.
    }
}