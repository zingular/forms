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
        // TODO: Implement getAggregators() method.
    }

    /**
     * @return array
     */
    public function getBuilders()
    {
        // TODO: Implement getBuilders() method.
    }

    /**
     * @return array
     */
    public function getConditions()
    {
        // TODO: Implement getConditions() method.
    }

    /**
     * @return array
     */
    public function getConverters()
    {
        // TODO: Implement getConverters() method.
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        // TODO: Implement getFilters() method.
    }

    /**
     * @return array
     */
    public function getFormBuilders()
    {
        // TODO: Implement getFormBuilders() method.
    }

    /**
     * @return array
     */
    public function getValidators()
    {
        // TODO: Implement getValidators() method.
    }
}