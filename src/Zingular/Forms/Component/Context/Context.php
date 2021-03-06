<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 30-1-2016
 * Time: 18:26
 */

namespace Zingular\Forms\Component\Context;
use Zingular\Forms\Component\Containers\Container;
use Zingular\Forms\Component\Containers\Prototypes;

/**
 * Class Context
 * @package Zingular\Form
 */
class Context
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var Container
     */
    protected $parent;

    /**
     * @var Prototypes
     */
    protected $prototypes;

    /**
     * @var string
     */
    protected $name;

    /**
     * @param string $id
     * @param Container $parent
     * @param Prototypes $prototypes
     */
    public function __construct($id,Container $parent = null,Prototypes $prototypes)
    {
        $this->id = $id;
        $this->name = $id;
        $this->parent = $parent;
        $this->prototypes = $prototypes;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFullId()
    {
        if(is_null($this->parent))
        {
            return $this->id;
        }

        return $this->parent->getFullId().'/'.$this->getId();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        if(is_null($this->parent))
        {
            return $this->getName();
        }
        return trim($this->parent->getDataPath().'/'.$this->getName(),'/');
    }

    /**
     * @param int $level
     * @return Container
     */
    public function getParent($level = 1)
    {
        $parent = $this->parent;

        if(is_null($parent))
        {
            return null;
        }

        $currentLevel = 1;

        while($currentLevel < $level)
        {
            $parent = $parent->getParent();

            if(is_null($parent))
            {
                return null;
            }

            $currentLevel++;
        }
        return $parent;
    }

    /**
     * @return Prototypes
     */
    public function getPrototypes()
    {
        return $this->prototypes;
    }

    /**
     * @return int
     */
    public function getIndex()
    {
        return $this->getParent()->getComponentIndex($this->getId());
    }

    /**
     * @return string
     */
    public function getDataPath()
    {
        if(is_null($this->parent))
        {
            return '';
        }

        return $this->parent->getDataPath();
    }
}