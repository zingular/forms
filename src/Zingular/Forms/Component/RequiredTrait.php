<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 30-1-2016
 * Time: 17:27
 */

namespace Zingular\Forms\Component;

/**
 * Class RequiredTrait
 * @package Zingular\Form
 */
trait RequiredTrait
{
    /**
     * @var bool
     */
    protected $required = false;

    /**
     * @param bool $required
     * @return $this
     */
    public function setRequired($required = true)
    {
        $this->required = $required;
        return $this;
    }

    /**
     * @return bool
     */
    public function isRequired()
    {
        return $this->required;
    }
}