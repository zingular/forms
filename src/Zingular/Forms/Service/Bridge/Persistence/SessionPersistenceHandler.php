<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 11-11-2015
 * Time: 22:04
 */

namespace Zingular\Forms\Service\Bridge\Persistence;
use Zingular\Forms\Exception\FormException;

/**
 * Class SessionPersistenceHandler
 * @package Zingular\Form\Bridges\Persistence
 */
class SessionPersistenceHandler implements PersistenceHandlerInterface
{
    const BASE_KEY = 'Z_FORMDATA';

    /**
     * @param string $name
     * @param mixed $value
     * @param $formId
     * @return mixed
     * @throws FormException
     */
    public function setValue($name,$value,$formId)
    {
        // test if there actually was a session started
        if(session_status() == PHP_SESSION_NONE)
        {
            throw new FormException("Cannot save form data in session: no session started!");
        }

        $_SESSION[self::BASE_KEY][$formId][$name] = $value;
    }

    /**
     * @param string $name
     * @param $formId
     * @return mixed
     */
    public function getValue($name,$formId)
    {
        return $this->hasValue($name,$formId) ? $_SESSION[self::BASE_KEY][$formId][$name] : null;
    }

    /**
     * @param string $name
     * @param $formId
     * @return bool
     */
    public function hasValue($name,$formId)
    {
        return isset($_SESSION[self::BASE_KEY]) && is_array($_SESSION[self::BASE_KEY]) && array_key_exists($name,$_SESSION[self::BASE_KEY][$formId]);
    }

    /**
     * @param $formId
     */
    public function clear($formId)
    {
        unset($_SESSION[self::BASE_KEY][$formId]);
    }
}