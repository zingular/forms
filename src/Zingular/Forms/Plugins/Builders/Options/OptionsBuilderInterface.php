<?php
/**
 * Created by PhpStorm.
 * User: michielleideman
 * Date: 18-03-16
 * Time: 08:32
 */

namespace Zingular\Forms\Plugins\Builders\Options;


use Zingular\Forms\Component\Containers\BuildableInterface;
use Zingular\Forms\Component\FormState;

/**
 * Interface OptionsBuilderInterface
 * @package Zingular\Forms\Plugins\Builders\Options
 */
interface OptionsBuilderInterface
{
    public function buildOptions(BuildableInterface $container,FormState $state,OptionsProvider $provider);
}