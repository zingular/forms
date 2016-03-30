<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 29-3-2016
 * Time: 20:26
 */

namespace Zingular\Forms\Compilers;
use Zingular\Forms\Component\ComponentInterface;
use Zingular\Forms\Component\Containers\Container;
use Zingular\Forms\Component\Containers\ContainerInterface;
use Zingular\Forms\Component\Containers\PostbuildableInterface;
use Zingular\Forms\Component\Containers\PrebuildableInterface;
use Zingular\Forms\Component\FormState;

/**
 * Class ContainerCompiler
 * @package Zingular\Forms\Compilers
 */
class ContainerCompiler
{
    /**
     * @param Compiler $compiler
     * @param Container $container
     * @param FormState $state
     * @param array $defaultValues
     */
    public function compile(Compiler $compiler,Container $container,FormState $state,array $defaultValues)
    {
        // pre-build
        if($container instanceof PrebuildableInterface)
        {
            // perform native prebuild
            $container->prebuild($state);

            $prebuilder = $container->getPrebuilder();

            if(!is_null($prebuilder))
            {
                if(is_string($prebuilder))
                {
                    $builder = $state->getServices()->getBuilders()->get($prebuilder);
                    $builder->build($container,$state);
                }
            }
        }

        // apply builders

        // compile children
        $this->compileChildren($compiler,$container->getComponents(),$state,$defaultValues);

        $container->resetAdoptionHistory();

        // post-build
        if($container instanceof PostbuildableInterface)
        {
            $container->postbuild($state);

            $postbuilder = $container->getPostbuilder();

            if(!is_null($postbuilder))
            {
                if(is_string($postbuilder))
                {
                    $builder = $state->getServices()->getBuilders()->get($postbuilder);
                    $builder->build($container,$state);
                }
            }
        }

        $this->compileChildren($compiler,$container->getAdoptionHistory(),$state,$defaultValues);

    }

    /**
     * @param Compiler $compiler
     * @param array $children
     * @param FormState $state
     * @param array $defaultValues
     */
    protected function compileChildren(Compiler $compiler,array $children,FormState $state,array $defaultValues)
    {
        /** @var ComponentInterface $child */
        foreach($children as $child)
        {
            $compiler->compile($child,$state,$defaultValues);
        }
    }
}