<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 28-1-2016
 * Time: 19:57
 */

namespace Zingular\Form\Service\Bridge\Csrf;

/**
 * Class DefaultCsrfHandler
 * @package Zingular\Form\Service\Csrf
 */
class DefaultCsrfHandler implements CsrfHandlerInterface
{
    /**
     * @param $formId
     * @return string
     */
    public function generateToken($formId)
    {
        return base64_encode(openssl_random_pseudo_bytes(32));
    }

    /**
     * @param string $token
     * @param $formId
     * @return string
     */
    public function generateTokenFieldname($token,$formId)
    {
        return md5($token);
    }
}