<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 6-2-2016
 * Time: 12:14
 */

namespace Zingular\Forms\Plugins\Builders\Prototype;

use Zingular\Forms\Component\Containers\PrototypesInterface;

/**
 * Interface PrototypeBuilderInterface
 * @package Service\Builder
 */
interface PrototypeBuilderInterface
{
    /**
     * @param PrototypesInterface $prototypes
     */
    public function buildPrototypes(PrototypesInterface $prototypes);
}