<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 5-2-2016
 * Time: 19:36
 */

namespace Zingular\Forms\Extension;
use Zingular\Forms\Component\Containers\PrototypesInterface;

/**
 * Class AbstractExtension
 * @package Zingular\Form\Extension
 */
class AbstractExtension implements FullExtensionInterface
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
        return array();
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
        return array();
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
     * @return array
     */
    public function getConverters()
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
}