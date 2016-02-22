<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 28-1-2016
 * Time: 19:38
 */

namespace Zingular\Forms\Service\Bridge\Csrf;

/**
 * Interface CsrfHandlerInterface
 * @package Zingular\Form\Service\Csrf
 */
interface CsrfHandlerInterface
{
    /**
     * @param $formId
     * @return string
     */
    public function generateToken($formId);

    /**
     * @param string $token
     * @param $formId
     * @return string
     */
    public function generateTokenFieldname($token,$formId);

}