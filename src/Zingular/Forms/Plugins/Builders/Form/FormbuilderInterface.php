<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 9-2-2016
 * Time: 21:18
 */

namespace Zingular\Forms\Plugins\Builders\Form;


use Zingular\Forms\Component\Container\Form;
use Zingular\Forms\Plugins\Builders\Container\BuilderInterface;
use Zingular\Forms\Service\Builder\Prototypes\PrototypeBuilderInterface;

/**
 * Interface FormbuilderInterface
 * @package Zingular\Forms\Service\Builder
 */
interface FormbuilderInterface extends BuilderInterface,PrototypeBuilderInterface
{
    /**
     * @param Form $form
     * @return mixed
     */
    public function configureForm(Form $form);
}