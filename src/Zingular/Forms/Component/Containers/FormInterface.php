<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 15-3-2016
 * Time: 20:22
 */

namespace Zingular\Forms\Component\Containers;

use Zingular\Forms\Component\DataComponentInterface;

/**
 * Interface FormInterface
 * @package Zingular\Forms\Component\Containers
 */
interface FormInterface extends
    ConfigurableFormInterface,
    PrototypesInterface,
    BuildableInterface,
    DataComponentInterface
{
    /**
     * @return bool
     */
    public function hasSubmit();

    /**
     * @return string
     */
    public function getHttpMethod();

    /**
     * @return string
     */
    public function getAction();

    /**
     * @return bool
     */
    public function isPersistent();

    /**
     * @param $name
     * @return mixed
     */
    public function getValue($name);

    /**
     * @return array
     */
    public function getValues();

    /**
     * @return string
     */
    public function render();

    /**
     * @return bool
     */
    public function valid();
}