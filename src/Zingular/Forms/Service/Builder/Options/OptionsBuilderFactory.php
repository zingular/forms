<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 11-2-2016
 * Time: 18:32
 */

namespace Zingular\Forms\Service\Builder\Options;
use Zingular\Forms\Exception\FormException;
use Zingular\Forms\Plugins\Builders\Options\OptionsBuilder;
use Zingular\Forms\Plugins\Builders\Options\OptionsBuilderInterface;

/**
 * Class OptionsBuilderFactory
 * @package Zingular\Forms\Service\Builder\Options
 */
class OptionsBuilderFactory
{
    /**
     * @param $type
     * @return OptionsBuilderInterface
     * @throws FormException
     */
    public function create($type)
    {
        switch($type)
        {
            case 'default': return new OptionsBuilder();
        }

        throw new FormException(sprintf("Cannot create options builder: unknown type '%s'",$type));
    }
}