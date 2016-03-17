<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 15-3-2016
 * Time: 20:14
 */

namespace Zingular\Forms\Component\Containers;

use Zingular\Forms\Exception\FormException;
use Zingular\Forms\Service\ServiceDefinerInterface;

/**
 * Interface ConfigurableFormInterface
 * @package Zingular\Forms\Component\Containers
 */
interface ConfigurableFormInterface extends
    HttpMethodInterface,
    ServiceDefinerInterface
{
    /**
     * @param $model
     * @throws FormException
     */
    public function setModel($model);

    /**
     * @param string $method
     * @throws FormException
     */
    public function setHttpMethod($method = self::GET);

    /**
     * @param $action
     */
    public function setAction($action = null);

    /**
     * @param bool $set
     */
    public function persistent($set = true);

    /**
     * @param string $name
     * @param mixed $value
     */
    public function setDefaultValue($name,$value);

    /**
     * @param array $values
     */
    public function setDefaultValues(array $values = array());
}