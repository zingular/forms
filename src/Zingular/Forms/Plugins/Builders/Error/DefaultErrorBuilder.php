<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 12-2-2016
 * Time: 15:45
 */

namespace Zingular\Forms\Plugins\Builders\Error;

use Zingular\Forms\Component\Container\BuildableInterface;
use Zingular\Forms\Component\FormContext;
use Zingular\Forms\Exception\EvaluationException;
use Zingular\Forms\Service\Bridge\Translation\TranslatorInterface;


class DefaultErrorBuilder implements  ErrorBuilderInterface
{
    /**
     * @param BuildableInterface $container
     * @param FormContext $context
     * @param array $errors
     * @param TranslatorInterface $translator
     * @return mixed
     */
    public function build(BuildableInterface $container, FormContext $context,array $errors, TranslatorInterface $translator)
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