<?php

namespace Zingular\Forms\Service\Conversion;
use Zingular\Forms\Plugins\Converters\ConverterInterface;

/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 24-2-2016
 * Time: 19:14
 */
interface ConverterFactoryInterface
{
    /**
     * @param string $type
     * @return ConverterInterface
     */
    public function create($type);
}