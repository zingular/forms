<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 30-3-2016
 * Time: 20:43
 */

namespace Zingular\Forms\Component;

use Zingular\Forms\Exception\FormException;

/**
 * Class ErrorComponentTrait
 * @package Zingular\Forms\Component
 */
trait ErrorComponentTrait
{
    /**
     * @var array
     */
    protected $errors = array();

    /**
     * @return bool
     */
    public function hasErrors()
    {
        return count($this->errors) > 0;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param FormException $e
     * @return $this
     */
    public function addError(FormException $e)
    {
        $this->errors[] = $e;
    }
}