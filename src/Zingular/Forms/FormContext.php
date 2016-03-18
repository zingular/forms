<?php
/**
 * Created by PhpStorm.
 * User: michielleideman
 * Date: 18-03-16
 * Time: 15:02
 */

namespace Zingular\Forms;

use Zingular\Forms\Component\Containers\PrototypesInterface;
use Zingular\Forms\Component\Context;
use Zingular\Forms\Service\ServicesInterface;

/**
 * Class FormContext
 * @package Zingular\Forms
 */
class FormContext extends Context
{
    /**
     * @var ServicesInterface
     */
    protected $services;

    /**
     * FormContext constructor.
     * @param ServicesInterface $services
     * @param string $formId
     * @param PrototypesInterface $prototypes
     */
    public function __construct(ServicesInterface $services,$formId,PrototypesInterface $prototypes)
    {
        parent::__construct($formId, null, $prototypes);
        $this->services = $services;
    }

    /**
     * @return ServicesInterface
     */
    public function getServices()
    {
        return $this->services;
    }
}