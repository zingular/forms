<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 30-1-2016
 * Time: 14:34
 */

namespace Zingular\Forms\Component;
use Zingular\Forms\Component\Context\Context;

/**
 * Interface ComponentInterface
 * @package Zingular\Form
 */
interface ComponentInterface extends NavigationInterface
{
    /**
     * @param Context $context
     */
    public function setContext(Context $context);

    /**
     * @return string
     */
    public function getId();

    /**
     * @return string
     */
    public function getFullId();

    /**
     * @return int
     */
    public function getIndex();
}