<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 9-2-2016
 * Time: 21:52
 */

namespace Zingular\Forms;

/**
 * Class TestModel
 * @package Zingular\Form
 */
class TestModel
{
    /**
     * @var string
     */
    public $prop1 = 'prop1111';

    /**
     * @var string
     */
    public $prop2 = 'djdjd';

    /**
     * @var string
     */
    public $prop3 = 'oud';

    /**
     * @var string
     */
    public $email = 'm.leideman@gmail.com';

    /**
     * @return string
     */
    public function getProp1()
    {
        return $this->prop1;
    }

    /**
     * @return string
     */
    public function getProp2()
    {
        return $this->prop2;
    }

    /**
     * @return string
     */
    public function getProp3()
    {
        return $this->prop3;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $value
     */
    public function setProp1($value)
    {
        $this->prop1 = $value;
    }

    /**
     * @param $value
     */
    public function setProp2($value)
    {
        $this->prop2 = $value;
    }

    /**
     * @param $value
     */
    public function setProp3($value)
    {
        $this->prop3 = $value;
    }

    /**
     * @param $value
     */
    public function setEmail($value)
    {
        $this->email = $value;
    }
}