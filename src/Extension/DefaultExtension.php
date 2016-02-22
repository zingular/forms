<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 19-2-2016
 * Time: 21:06
 */

namespace Zingular\Form\Extension;
use Zingular\Form\Component\Container\Prototypes;
use Zingular\Form\Service\Builder\FieldsetBuilder;
use Zingular\Form\Service\Builder\RegisterableBuilderWrapper;
use Zingular\Form\Service\Evaluation\CallableValidator;

/**
 * Class DefaultExtension
 * @package Zingular\Form\Extension
 */
class DefaultExtension extends AbstractExtension
{
    /**
     * @param Prototypes $prototypes
     */
    public function buildPrototypes(Prototypes $prototypes) {}

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