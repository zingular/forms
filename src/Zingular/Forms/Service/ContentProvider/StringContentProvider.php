<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 3-3-2016
 * Time: 19:46
 */

namespace Zingular\Forms\Service\ContentProvider;

/**
 * Class StringContentProvider
 * @package Zingular\Forms\Service\ContentProvider
 */
class StringContentProvider implements ContentProviderInterface
{
    /**
     * @var string
     */
    protected $content;

    /**
     * @param string $content
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
}