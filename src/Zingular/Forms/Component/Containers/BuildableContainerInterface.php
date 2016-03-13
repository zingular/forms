<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 13-3-2016
 * Time: 20:07
 */

namespace Zingular\Forms\Component\Containers;

use Zingular\Forms\Component\Elements\Controls\Button;
use Zingular\Forms\Component\Elements\Controls\Checkbox;
use Zingular\Forms\Component\Elements\Controls\Input;
use Zingular\Forms\Component\Elements\Controls\Select;
use Zingular\Forms\Component\Elements\Controls\Textarea;
use Zingular\Forms\Exception\FormException;
/**
 * Class BuildableContainerInterface
 * @package Zingular\Forms\Component\Containers
 */
interface BuildableContainerInterface extends BuildableInterface
{
    /**
     * @return string
     */
    public function getId();

    /**
     * @return string
     */
    public function getFullId();

    /***************************************************************
     * GENERIC
     **************************************************************/

    /**
     * @param $name
     * @return $this
     */
    public function removeComponent($name);

    /**
     * @return array
     */
    public function getErrors();

    /***************************************************************
     * GET
     **************************************************************/

    /**
     * @param $name
     * @return Input
     * @throws FormException
     */
    public function getInput($name);

    /**
     * @param $name
     * @return Checkbox
     * @throws FormException
     */
    public function getCheckbox($name);

    /**
     * @param $name
     * @return Select
     * @throws FormException
     */
    public function getSelect($name);

    /**
     * @param $name
     * @return Textarea
     * @throws FormException
     */
    public function getTextarea($name);

    /**
     * @param $name
     * @return Button
     * @throws FormException
     */
    public function getButton($name);

    /**
     * @param $name
     * @return Container
     * @throws FormException
     */
    public function getContainer($name);

    /**
     * @param $name
     * @return Aggregator
     * @throws FormException
     */
    public function getAggregator($name);

    /**
     * @param $name
     * @return Container
     * @throws FormException
     */
    public function getFieldset($name);

    /**
     * @param $name
     * @return Container
     * @throws FormException
     */
    public function getField($name);

    /**
     * @param $name
     * @return Row
     * @throws FormException
     */
    public function getRow($name);
}