<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 3-3-2016
 * Time: 19:39
 */

namespace Zingular\Forms\Service\ContentProvider;

/**
 * Class CallableContentProvider
 * @package Zingular\Forms\Service\ContentProvider
 */
class CallableContentProvider implements ContentProviderInterface
{
    /**
     * @var callable
     */
    protected $callable;

    /**
     * @param callable $callable
     */
    public function __construct($callable)
    {
        $this->callable = $callable;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return call_user_func($this->callable);
    }
}