<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 12:49
 */

namespace Zingular\Forms\Service\Builder\Container;

use Zingular\Forms\Builder;
use Zingular\Forms\Exception\FormException;
use Zingular\Forms\Plugins\Builders\Container\FieldBuilder;
use Zingular\Forms\Plugins\Builders\Container\FieldsetBuilder;
use Zingular\Forms\Plugins\Builders\Container\RuntimeBuilderInterface;
use Zingular\Forms\Plugins\Builders\Container\DefaultErrorBuilder;
use Zingular\Forms\Plugins\Builders\Container\DateTimeSelectBuilder;

/**
 * Class BuilderFactory
 * @package Zingular\Form\Service\Builder
 */
class BuilderFactory implements BuilderFactoryInterface
{
    /**
     * @param $type
     * @return RuntimeBuilderInterface
     * @throws FormException
     */
    public function create($type)
    {
        switch($type)
        {
            case Builder::FIELD: return new FieldBuilder();
            case Builder::FIELDSET: return new FieldsetBuilder();
            case Builder::DATE_TIME_SELECT: return new DateTimeSelectBuilder();
            case Builder::ERROR: return new DefaultErrorBuilder();
        }

        throw new FormException(sprintf("Cannot create container builder, unknown container builder type: '%s'",$type));
    }
}