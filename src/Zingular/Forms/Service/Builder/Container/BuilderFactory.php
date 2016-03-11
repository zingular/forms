<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 12:49
 */

namespace Zingular\Forms\Service\Builder\Container;

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
    const FIELD = 'field';
    const FIELDSET = 'fieldset';
    const DATE_TIME_SELECT = 'dateTimeSelect';
    const ERROR = 'error';

    /**
     * @var array
     */
    protected $types = array
    (
        self::FIELD => FieldBuilder::class,
        self::FIELDSET=> FieldsetBuilder::class,
        self::DATE_TIME_SELECT => DateTimeSelectBuilder::class,
        self::ERROR => DefaultErrorBuilder::class
    );

    /**
     * @param $type
     * @return RuntimeBuilderInterface
     * @throws FormException
     */
    public function create($type)
    {
        if(!isset($this->types[$type]))
        {
            throw new FormException(sprintf("Cannot create container builder, unknown container builder type: '%s'",$type));
        }

        $class = $this->types[$type];

        return new $class();
    }

    /**
     * @param string $type
     * @return bool
     */
    public function has($type)
    {
        return isset($this->types[$type]);
    }
}