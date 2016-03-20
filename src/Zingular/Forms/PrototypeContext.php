<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 20-3-2016
 * Time: 14:48
 */

namespace Zingular\Forms;

use Zingular\Forms\Component\Containers\PrototypesInterface;
use Zingular\Forms\Component\Context;

/**
 * Class PrototypeContext
 * @package Zingular\Forms
 */
class PrototypeContext extends Context
{
    /**
     * @param string $id
     * @param PrototypesInterface $prototypes
     */
    public function __construct($id,PrototypesInterface $prototypes)
    {
        parent::__construct($id,null,$prototypes);
    }
}