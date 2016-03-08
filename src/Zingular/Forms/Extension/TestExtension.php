<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 23-2-2016
 * Time: 16:46
 */

namespace Zingular\Forms\Extension;

use Zingular\Forms\Component\Container\PrototypesInterface;

/**
 * Class TestExtension
 * @package Zingular\Forms\Extension
 */
class TestExtension extends AbstractExtension
{
    /**
     * @param PrototypesInterface $prototypes
     */
    public function buildPrototypes(PrototypesInterface $prototypes)
    {
        $prototypes->defineSelect('selecter');

        $prototypes->defineFieldset('test1234')
            ->addInput('testInput')->nextSibling()
            ->useSelect('selecter','aapje');
    }
}