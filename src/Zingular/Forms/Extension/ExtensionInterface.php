<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 5-2-2016
 * Time: 19:36
 */

namespace Zingular\Forms\Extension;

use Zingular\Forms\Service\Builder\PrototypeBuilderInterface;

/**
 * Interface ExtensionInterface
 * @package Zingular\Form\Extension
 */
interface ExtensionInterface extends PrototypeBuilderInterface
{
    /**
     * @return array
     */
    public function getValidators();

    /**
     * @return array
     */
    public function getFilters();

    /**
     * @return array
     */
    public function getBuilders();

    /**
     * @return array
     */
    public function getAggregators();

    /**
     * @return array
     */
    public function getConditions();
}