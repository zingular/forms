<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 12-2-2016
 * Time: 15:45
 */

namespace Zingular\Forms\Plugins\Builders\Container;

use Zingular\Forms\Component\Containers\BuildableInterface;
use Zingular\Forms\Component\FormState;
use Zingular\Forms\Exception\EvaluationException;
use Zingular\Forms\Exception\FormException;

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
        foreach($container->getErrors() as $index=>$e)
        {
            if($e instanceof EvaluationException)
            {
                $container->addLabel('lblError'.$index,$e->getComponent()->getId())
                    ->setFor($e->getComponent())
                    ->addCssClass('error')
                    ->setTranslationKey('error.'.$e->getType(),$e->getParams());
            }
            elseif($e instanceof FormException)
            {
                $container->addLabel('lblError'.$index)
                    ->addCssClass('error')
                    ->setTranslationKey('error.'.$e->getType(),$e->getParams());
            }
            elseif($e instanceof \Exception)
            {
                $container->addLabel('lblError'.$index)
                ->addCssClass('error')
                ->setContent($e->getMessage().get_class($e));
                //->setTranslationKey('error.generic')
                // TODO: check debug mode: if debug, show full exception text, else show generic error
            }
        }
    }
}