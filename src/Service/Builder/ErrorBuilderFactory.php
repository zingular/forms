<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 12-2-2016
 * Time: 15:48
 */

namespace Zingular\Form\Service\Builder;


use Zingular\Form\ErrorBuilder;
use Zingular\Form\Exception\FormException;

class ErrorBuilderFactory
{
    /**
     * @param $type
     * @return DefaultErrorBuilder
     * @throws FormException
     */
    public function create($type)
    {
        switch($type)
        {
            case ErrorBuilder::STANDARD: return new DefaultErrorBuilder();
        }

        throw new FormException(sprintf("Unknown error builder type: '%s'",$type));
    }
}