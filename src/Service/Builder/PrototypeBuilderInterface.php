<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 12:14
 */

namespace Zingular\Form\Service\Builder;

use Zingular\Form\Component\Container\Prototypes;

/**
 * Interface PrototypeBuilderInterface
 * @package Service\Builder
 */
interface PrototypeBuilderInterface
{
    /**
     * @param Prototypes $prototypes
     */
    public function buildPrototypes(Prototypes $prototypes);
}