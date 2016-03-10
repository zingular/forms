<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 12-2-2016
 * Time: 15:45
 */

namespace Zingular\Forms\Plugins\Builders\Error;

use Zingular\Forms\Component\Container\BuildableInterface;
use Zingular\Forms\Component\State;
use Zingular\Forms\Exception\EvaluationException;

/**
 * Class DefaultErrorBuilder
 * @package Zingular\Forms\Plugins\Builders\Error
 */
class DefaultErrorBuilder implements  ErrorBuilderInterface
{
    /**
     * @param BuildableInterface $container
     * @param State $context
     * @param array $errors
     * @return mixed
     */
    public function build(BuildableInterface $container, State $context,array $errors)
    {
        /** @var \Exception $e */
        foreach($errors as $index=>$e)
        {
            /** @var EvaluationException $e */
            if($e instanceof EvaluationException)
            {
                $container->addLabel('lblError'.$index)
                    ->setFor($e->getComponent())
                    ->addCssClass('error')
                    ->setTranslationKey('error.'.$e->getType(),$e->getParams())
                    ->compile($context);
            }
        }
    }
}