<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 21:06
 */

namespace Zingular\Forms\Extension;
use Zingular\Forms\Component\Container\PrototypesInterface;
use Zingular\Forms\Plugins\Builders\Container\FieldsetBuilder;
use Zingular\Forms\Plugins\Builders\Container\RegisterableBuilderWrapper;
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
            new RegisterableBuilderWrapper('myBuilder',new FieldsetBuilder())
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


    public function validate()
    {
        return true;
    }
}