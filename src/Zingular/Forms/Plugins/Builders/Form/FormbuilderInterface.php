<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 9-2-2016
 * Time: 21:18
 */

namespace Zingular\Forms\Plugins\Builders\Form;

use Zingular\Forms\Component\Containers\BuildableInterface;
use Zingular\Forms\Component\Containers\Form;
use Zingular\Forms\Component\Containers\PositionableInterface;
use Zingular\Forms\Component\Containers\PrototypesInterface;

/**
 * Interface FormBuilderInterface
 * @package Zingular\Forms\Service\Builder
 */
interface FormBuilderInterface extends PositionableInterface
{
    /**
     * @param PrototypesInterface $form
     */
    public function buildPrototypes(PrototypesInterface $form);

    /**
     * @param BuildableInterface $form
     */
    public function buildForm(BuildableInterface $form);

    /**
     * @param Form $form
     * @return mixed
     */
    public function configureForm(Form $form);
}