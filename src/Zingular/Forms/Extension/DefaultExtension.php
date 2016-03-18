<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 21:06
 */

namespace Zingular\Forms\Extension;
use Zingular\Forms\Component\ComponentInterface;
use Zingular\Forms\Component\Containers\PrototypesInterface;
use Zingular\Forms\Component\FormState;
use Zingular\Forms\Plugins\Builders\Container\FieldsetBuilder;
use Zingular\Forms\Plugins\Builders\Container\BuilderTypeWrapper;
use Zingular\Forms\Plugins\Evaluators\CallableValidatorType;
use Zingular\Forms\Service\Bridge\Translation\CallableTranslationKeyWildcard;

/**
 * Class DefaultExtension
 * @package Zingular\Form\Extension
 */
class DefaultExtension implements FullExtensionInterface
{
    /**
     * @param PrototypesInterface $prototypes
     */
    public function buildPrototypes(PrototypesInterface $prototypes) {}

    /**
     * @return array
     */
    public function getValidatorTypes()
    {
        return array
        (
            new CallableValidatorType('doValidate',array($this,'validate'))
        );
    }

    /**
     * @return array
     */
    public function getFilterTypes()
    {
        return array();
    }

    /**
     * @return array
     */
    public function getBuilderTypes()
    {
        return array
        (
            new BuilderTypeWrapper('myBuilder',new FieldsetBuilder())
        );
    }

    /**
     * @return array
     */
    public function getAggregators()
    {
        return array();
    }

    /**
     * @return array
     */
    public function getConditionTypes()
    {
        return array();
    }

    /**
     * @return array
     */
    public function getConverterTypes()
    {
        return array();
    }

    /**
     * @return array
     */
    public function getFormBuilders()
    {
        return array();
    }

    /**
     * @return array
     */
    public function getTranslationWildcards()
    {
        return array
        (
            new CallableTranslationKeyWildcard('bla',array($this,'replaceBla'))
        );
    }


    /**
     * @param ComponentInterface $component
     * @param FormState $state
     * @return string
     */
    public function replaceBla(ComponentInterface $component,FormState $state)
    {
        return $state->getFormId();
    }



    /**
     * @return bool
     */
    public function validate()
    {
        return true;
    }

    /**
     * @return string
     */
    public function getExtensionName()
    {
        return 'default';
    }

}