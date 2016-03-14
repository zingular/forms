<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 12-2-2016
 * Time: 17:16
 */

namespace Zingular\Forms\Plugins\Builders\Form;

use Zingular\Forms\Component\Containers\BuildableInterface;
use Zingular\Forms\Component\Containers\Form;
use Zingular\Forms\Component\Containers\PrototypesInterface;


/**
 * Class XmlBuilder
 * @package Zingular\Forms\Service\Builder
 */
class XmlBuilder implements FormBuilderInterface
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
     * @param BuildableInterface $container
     */
    public function buildForm(BuildableInterface $container)
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

    /**
     * @param PrototypesInterface $prototypes
     */
    public function buildPrototypes(PrototypesInterface $prototypes)
    {
        // TODO: Implement buildPrototypes() method.
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'xml';
    }
}