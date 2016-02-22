<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 11-11-2015
 * Time: 22:04
 */

namespace Zingular\Form\Service\Bridge\Persistence;

/**
 * Interface PersistenceHandlerInterface
 * @package Zingular\Form\Bridges\Persistence
 */
interface PersistenceHandlerInterface
{
    /**
     * @param string $name
     * @param mixed $value
     * @param $formId
     * @return
     */
    public function setValue($name,$value,$formId);

    /**
     * @param string $name
     * @param $formId
     * @return mixed
     */
    public function getValue($name,$formId);

    /**
     * @param string $name
     * @param $formId
     * @return bool
     */
    public function hasValue($name,$formId);

    /**
     * @param $formId
     */
    public function clear($formId);
}