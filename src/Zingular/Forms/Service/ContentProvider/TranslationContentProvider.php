<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 3-3-2016
 * Time: 19:35
 */

namespace Zingular\Forms\Service\ContentProvider;

use Zingular\Forms\Service\Bridge\Translation\TranslatorInterface;

/**
 * Class TranslationContentProvider
 * @package Zingular\Forms\Service\ContentProvider
 */
class TranslationContentProvider implements ContentProviderInterface
{
    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * @var string
     */
    protected $translationKey;

    /**
     * @var array
     */
    protected $params;

    /**
     * @param TranslatorInterface $translator
     * @param $translationKey
     * @param array $params
     */
    public function __construct(TranslatorInterface $translator,$translationKey,array $params = array())
    {
        $this->translationKey = $translationKey;
        $this->translator = $translator;
        $this->params = $params;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->translator->translate($this->translationKey,$this->params);
    }
}