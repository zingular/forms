<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 12-2-2016
 * Time: 15:45
 */

namespace Zingular\Form\Service\Builder;

use Zingular\Form\Component\Container\Container;
use Zingular\Form\Exception\EvaluationException;
use Zingular\Form\Service\Bridge\Translation\TranslatorInterface;

class DefaultErrorBuilder implements  ErrorBuilderInterface
{
    /**
     * @param Container $container
     * @param array $errors
     * @param TranslatorInterface $translator
     * @return mixed
     */
    public function build(Container $container, array $errors, TranslatorInterface $translator)
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
                    ->setText($translator->translate('error.'.$e->getType(),$e->getParams()));
            }
        }
    }
}