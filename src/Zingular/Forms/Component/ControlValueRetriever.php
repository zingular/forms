<?php
/**
 * Created by PhpStorm.
 * User: Giel
 * Date: 24-2-2016
 * Time: 21:02
 */

namespace Zingular\Forms\Component;


use Zingular\Forms\Component\Element\Control\AbstractControl;
use Zingular\Forms\Service\Evaluation\EvaluatorConfigCollection;

class ControlValueRetriever extends AbstractValueRetriever
{
    /**
     * @var AbstractControl
     */
    protected $control;

    /**
     * @param DataUnitInterface $component
     * @param FormContext $context
     * @param EvaluatorConfigCollection $evaluators
     */
    public function __construct(DataUnitInterface $component,FormContext $context,EvaluatorConfigCollection $evaluators)
    {
        parent::__construct($component,$context,$evaluators);
        $this->control = $component;
    }

    /**
     * @param $value
     * @return bool
     */
    protected function preprocessInputValue($value)
    {
        // if the value is null, return that
        if(is_null($value))
        {
            return null;
        }
        // if the value is an empty string, and that is considered empty, return null
        elseif($this->control->emptyStringIsValue() && (is_string($value) && strlen($value) === 0))
        {
            return null;
        }

        // trim the raw value
        if($this->control->shouldTrimValue() && is_string($value))
        {
            $value = trim($value);
        }

        return $value;
    }
}