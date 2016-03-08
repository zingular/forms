<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 9-2-2016
 * Time: 21:18
 */

namespace Zingular\Forms\Service\Builder;


use Zingular\Forms\Component\Container\Form;

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