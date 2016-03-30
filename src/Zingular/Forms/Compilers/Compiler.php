<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 30-3-2016
 * Time: 18:02
 */

namespace Zingular\Forms\Compilers;

use Zingular\Forms\Component\ComponentInterface;
use Zingular\Forms\Component\Containers\Aggregator;
use Zingular\Forms\Component\Containers\ContainerInterface;
use Zingular\Forms\Component\Elements\Contents\Content;
use Zingular\Forms\Component\Elements\Controls\AbstractControl;
use Zingular\Forms\Component\FormState;
use Zingular\Forms\Exception\ComponentException;

/**
 * Class Compiler
 * @package Zingular\Forms\Compilers
 */
class Compiler
{
    /**
     * @var CompilerPool
     */
    protected $pool;

    /**
     * @param CompilerPool $pool
     */
    public function __construct(CompilerPool $pool)
    {
        $this->pool = $pool;
    }

    /**
     * @param ComponentInterface $component
     * @param FormState $state
     * @param array $defaultValues
     */
    public function compile(ComponentInterface $component,FormState $state,array $defaultValues)
    {
        if($component instanceof Aggregator) // TODO: convert to interface
        {
            $this->compileAggregator($component,$state,$defaultValues);
        }
        elseif($component instanceof ContainerInterface)
        {
            $this->compileContainer($component,$state,$defaultValues);
        }
        elseif($component instanceof AbstractControl) // TODO: convert to interface
        {
            $this->compileControl($component,$state,$defaultValues);
        }
        elseif($component instanceof Content) // TODO: convert to interface
        {
            $this->compileContent($component,$state);
        }
        else
        {
            // TODO: what to do?
        }
    }

    /**
     * @param Aggregator $component
     * @param FormState $state
     * @param array $defaultValues
     */
    protected function compileAggregator(Aggregator $component,FormState $state,array $defaultValues)
    {
        $this->pool->getAggregatorCompiler()->compile($component,$state,$defaultValues);
    }

    /**
     * @param ContainerInterface $component
     * @param FormState $state
     * @param array $defaultValues
     */
    protected function compileContainer(ContainerInterface $component,FormState $state,array $defaultValues)
    {
        $this->pool->getContainerCompiler()->compile($component,$state,$defaultValues);
    }

    /**
     * @param AbstractControl $component
     * @param FormState $state
     * @param array $defaultValues
     * @throws ComponentException
     */
    protected function compileControl(AbstractControl $component,FormState $state,array $defaultValues)
    {
        $this->pool->getControlCompiler()->compile($component,$state,$defaultValues);
    }

    /**
     * @param Content $component
     * @param FormState $state
     */
    protected function compileContent(Content $component,FormState $state)
    {
        $this->pool->getContentCompiler()->compile($component,$state);
    }
}