<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 12:49
 */

namespace Zingular\Forms\Service\Builder;
use Zingular\Forms\Exception\FormException;

/**
 * Class BuilderFactory
 * @package Zingular\Form\Service\Builder
 */
class BuilderFactory implements BuilderFactoryInterface
{
    const FIELD = 'field';
    const FIELDSET = 'fieldset';
    const DATE_TIME_SELECT = 'dateTimeSelect';

    /**
     * @var array
     */
    protected $types = array
    (
        'field' => FieldBuilder::class,
        'fieldset'=> FieldsetBuilder::class,
        'dateTimeSelect' => DateTimeSelectBuilder::class,
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