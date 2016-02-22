<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 12-2-2016
 * Time: 17:16
 */

namespace Zingular\Form\Service\Builder;

use Zingular\Form\Component\Container\Container;
use Zingular\Form\Component\Container\Form;

class XmlBuilder implements FormbuilderInterface
{
    /**
     * @var string
     */
    protected $xmlPath;

    /**
     * @param string $xmlPath
     */
    public function __construct($xmlPath)
    {
        $this->xmlPath = $xmlPath;
    }

    /**
     * @param Container $container
     */
    public function build(Container $container)
    {
        // TODO: parse xml file and extract form structure components and configurations and apply them
    }

    /**
     * @param Form $form
     * @return mixed
     */
    public function configureForm(Form $form)
    {
        // TODO: Implement configureForm() method.
    }
}