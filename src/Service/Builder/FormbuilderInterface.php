<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 9-2-2016
 * Time: 21:18
 */

namespace Zingular\Form\Service\Builder;


use Zingular\Form\Component\Container\Form;

interface FormbuilderInterface extends BuilderInterface
{
    /**
     * @param Form $form
     * @return mixed
     */
    public function configureForm(Form $form);
}