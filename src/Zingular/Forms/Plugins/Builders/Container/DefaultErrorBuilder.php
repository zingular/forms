<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 12-2-2016
 * Time: 15:45
 */

namespace Zingular\Forms\Plugins\Builders\Container;

use Zingular\Forms\Component\Container\BuildableInterface;
use Zingular\Forms\Component\FormState;
use Zingular\Forms\Exception\EvaluationException;

/**
 * Class DefaultErrorBuilder
 * @package Zingular\Forms\Plugins\Builders\Error
 */
class DefaultErrorBuilder implements RuntimeBuilderInterface
{
    /**
     * @param BuildableInterface $container
     * @param FormState $context
     */
    public function build(BuildableInterface $container, FormState $context)
    {
        /** @var \Exception $e */
        foreach($container->getErrors() as $index=>$e)
        {
            /** @var EvaluationException $e */
            if($e instanceof EvaluationException)
            {
                $container->addLabel('lblError'.$index,$e->getComponent()->getId())
                    ->setFor($e->getComponent())
                    ->addCssClass('error')
                    ->setTranslationKey('error.'.$e->getType(),$e->getParams())
                    ->compile($context);
            }
        }
    }
}