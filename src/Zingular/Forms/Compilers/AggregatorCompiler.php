<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 29-3-2016
 * Time: 21:03
 */

namespace Zingular\Forms\Compilers;

/**
 * Class AggregatorCompiler
 * @package Zingular\Forms\Compilers
 */
class AggregatorCompiler extends InputCompiler
{
    /**
     * @var ContainerCompiler
     */
    protected $compiler;

    /**.
     * @param ContainerCompiler $compiler
     */
    public function __construct(ContainerCompiler $compiler)
    {
        $this->compiler = $compiler;
    }



    // TODO
}