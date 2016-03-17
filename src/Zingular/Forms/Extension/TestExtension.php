<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 23-2-2016
 * Time: 16:46
 */

namespace Zingular\Forms\Extension;

use Zingular\Forms\Component\Containers\PrototypesInterface;

/**
 * Class TestExtension
 * @package Zingular\Forms\Extension
 */
class TestExtension implements FullExtensionInterface
{
    /**
     * @param PrototypesInterface $prototypes
     */
    public function buildPrototypes(PrototypesInterface $prototypes)
    {
        $prototypes->defineSelect('selecter');


        $prototypes->defineFieldset('test1234')
            ->addInput('testInput')->next()
            ->useSelect('selecter','aapje');
    }

    /**
     * @return string
     */
    public function getExtensionName()
    {
        return 'test';
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
    public function getBuilderTypes()
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
    public function getFilterTypes()
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
    public function getValidatorTypes()
    {
        return array();
    }
}