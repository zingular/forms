<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 16-2-2016
 * Time: 21:00
 */

namespace Zingular\Forms\Service\Evaluation;

use Zingular\Forms\Exception\FormException;
use Zingular\Forms\Filter;
use Zingular\Forms\Plugins\Evaluators\CallableFilterType;
use Zingular\Forms\Plugins\Evaluators\FilterInterface;

/**
 * Class FilterFactory
 * @package Zingular\Form\Evaluation
 */
class FilterFactory implements FilterFactoryInterface
{
    /**
     * @param string $name
     * @return FilterInterface
     * @throws FormException
     */
    public function create($name)
    {
        switch($name)
        {
            case Filter::UPPERCASE: return new CallableFilterType(Filter::UPPERCASE,array($this,Filter::UPPERCASE));
            case Filter::LOWERCASE: return new CallableFilterType(Filter::LOWERCASE,array($this,Filter::LOWERCASE));
            case Filter::TRIM: return new CallableFilterType(Filter::TRIM,array($this,Filter::TRIM));
            case Filter::TRIM_LEFT: return new CallableFilterType(Filter::TRIM_LEFT,array($this,Filter::TRIM_LEFT));
            case Filter::TRIM_RIGHT: return new CallableFilterType(Filter::TRIM_RIGHT,array($this,Filter::TRIM_RIGHT));
            case Filter::FORCE_LEADING: return new CallableFilterType(Filter::FORCE_LEADING,array($this,Filter::FORCE_LEADING));
            case Filter::FORCE_TRAILING: return new CallableFilterType(Filter::FORCE_TRAILING,array($this,Filter::FORCE_TRAILING));
            default: throw new FormException(sprintf("Cannot create filter: unknown filter type '%s'",$name));
        }
    }

    /**
     * @param $value
     * @return string
     */
    public function uppercase($value)
    {
        return strtoupper((string) $value);
    }

    /**
     * @param $value
     * @return string
     */
    public function lowercase($value)
    {
        return strtolower((string) $value);
    }

    /**
     * @param $value
     * @param null $chars
     * @return string
     */
    public function trim($value,$chars = null)
    {
        $value = (string) $value;
        return is_string($chars) ? trim($value,$chars) : trim($value);
    }

    /**
     * @param $value
     * @param null $chars
     * @return string
     */
    public function ltrim($value,$chars = null)
    {
        $value = (string) $value;
        return is_string($chars) ? ltrim($value,$chars) : ltrim($value);
    }

    /**
     * @param $value
     * @param null $chars
     * @return string
     */
    public function rtrim($value,$chars = null)
    {
        $value = (string) $value;
        return is_string($chars) ? rtrim($value,$chars) : rtrim($value);
    }

    /**
     * @param $value
     * @param $string
     * @return string
     */
    public function leading($value,$string)
    {
        $value = (string) $value;

        if(strpos($value,$string) !== 0)
        {
            return $string.$value;
        }

        return $value;
    }

    /**
     * @param $value
     * @param $string
     * @return string
     */
    public function trailing($value,$string)
    {
        $value = (string) $value;

        if(strrpos($value,$string) !== (mb_strlen($value) - mb_strlen($string)))
        {
            return $value.$string;
        }

        return $value;
    }

}