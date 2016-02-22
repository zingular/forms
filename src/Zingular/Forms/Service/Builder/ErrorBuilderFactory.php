<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 12-2-2016
 * Time: 15:48
 */

namespace Zingular\Forms\Service\Builder;


use Zingular\Forms\ErrorBuilder;
use Zingular\Forms\Exception\FormException;

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