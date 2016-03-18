<?php

namespace Zingular\Forms\Events;
use Zingular\Forms\Component\Containers\FormInterface;

/**
 * Class FormEvent
 * @package Zingular\Forms\Events
 */
class FormEvent extends Event
{
    const VALID = 'form.valid';
    const INVALID = 'form.invalid';

    /**
     * @var FormInterface
     */
    protected $form;

    /**
     * @param string $type
     * @param FormInterface $form
     * @param bool $cancellable
     */
    public function __construct($type = self::GENERIC,FormInterface $form,$cancellable = true)
    {
        parent::__construct($type,$cancellable);
        $this->form = $form;
    }

    /**
     * @return FormInterface
     */
    public function getForm()
    {
        return $this->form;
    }
}