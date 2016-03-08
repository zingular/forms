<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 12-2-2016
 * Time: 15:48
 */

namespace Zingular\Forms\Service\Builder\Error;


use Zingular\Forms\ErrorBuilder;
use Zingular\Forms\Exception\FormException;
use Zingular\Forms\Plugins\Builders\Error\DefaultErrorBuilder;

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
            case ErrorBuilder::STANDARD: return new \Zingular\Forms\Plugins\Builders\Error\DefaultErrorBuilder();
        }

        throw new FormException(sprintf("Unknown error builder type: '%s'",$type));
    }
}