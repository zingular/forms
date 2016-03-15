<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 21:06
 */

namespace Zingular\Forms\Extension;
use Zingular\Forms\Component\Containers\PrototypesInterface;
use Zingular\Forms\Plugins\Builders\Container\FieldsetBuilder;
use Zingular\Forms\Plugins\Builders\Container\BuilderTypeWrapper;
use Zingular\Forms\Plugins\Evaluators\CallableValidator;

/**
 * Class DefaultExtension
 * @package Zingular\Form\Extension
 */
class DefaultExtension extends AbstractExtension
{
    /**
     * @param PrototypesInterface $prototypes
     */
    public function buildPrototypes(PrototypesInterface $prototypes) {}

    /**
     * @return array
     */
    public function getValidators()
    {
        return array
        (
            new CallableValidator('doValidate',array($this,'validate'))
        );
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return array();
    }

    /**
     * @return array
     */
    public function getBuilders()
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
    public function getConditions()
    {
        return array();
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