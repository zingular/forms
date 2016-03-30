<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 30-3-2016
 * Time: 17:46
 */

namespace Zingular\Forms\Compilers;

/**
 * Class CompilerFactory
 * @package Zingular\Forms\Compilers
 */
class CompilerFactory
{
    /**
     * @return ControlCompiler
     */
    public function createControlCompiler()
    {
        return new ControlCompiler();
    }

    /**
     * @return ContentCompiler
     */
    public function createContentCompiler()
    {
        return new ContentCompiler();
    }

    /**
     * @return ContainerCompiler
     */
    public function createContainerCompiler()
    {
        return new ContainerCompiler();
    }

    /**
     * @param ContainerCompiler $containerCompiler
     * @param ControlCompiler $controlCompiler
     * @return AggregatorCompiler
     */
    public function createAggregatorCompiler(ContainerCompiler $containerCompiler,ControlCompiler $controlCompiler)
    {
        return new AggregatorCompiler($containerCompiler,$controlCompiler);
    }
}