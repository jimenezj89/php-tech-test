<?php

namespace TechTest\Part2\Models;


use DateTime;

class InputParamsValidator
{
    private $paramsToValidate;

    public function __construct($someParamsToValidate)
    {
        $this->paramsToValidate = $someParamsToValidate;
    }


    public function validate()
    {

        foreach ($this->paramsToValidate as $paramToValidate) {
            if (!$this->{'validate' . $this->parseValidationRuleFromType($paramToValidate['type'])}($paramToValidate['value'])) {
                throw new \Exception("The param ${$paramToValidate['name']} has invalid value!");
            }
        }

        return true;
    }

    private function parseValidationRuleFromType($rule)
    {
        switch ($rule) {
            case 'integer':
                return 'Integer';
            case 'float':
                return 'Float';
            case 'string':
                return 'String';
            case 'boolean':
                return 'Boolean';
            case 'array_of_strings':
                return 'ArrayOfStrings';
            case 'array_of_integers':
                return 'ArrayOfIntegers';
            case 'email':
                return 'Email';
            case 'url':
                return 'Url';
            case 'date':
                return 'Date';
            default:
                return false;
        }
    }

    private function validateInteger($paramValue): bool
    {
        return is_integer($paramValue);
    }

    private function validateFloat($paramValue): bool
    {
        return is_float($paramValue);
    }

    private function validateString($paramValue): bool
    {
        return is_float($paramValue);
    }

    private function validateBoolean($paramValue): bool
    {
        return is_bool($paramValue);
    }

    private function validateArray($paramValue): bool
    {
        return is_array($paramValue);
    }

    private function validateArrayOfStrings($paramValue): bool
    {
        if (!$this->validateArray($paramValue)) {
            return false;
        }
        
        foreach ($paramValue as $paramValueItem) {
            if (!$this->validateString($paramValueItem)) {
                return false;
            }
        }

        return true;
    }

    private function validateArrayOfIntegers($paramValue): bool
    {
        if (!$this->validateArray($paramValue)) {
            return false;
        }

        foreach ($paramValue as $paramValueItem) {
            if (!$this->validateInteger($paramValueItem)) {
                return false;
            }
        }

        return true;
    }

    private function validateEmail($paramValue): bool
    {
        return preg_match('(?:[a-z0-9!#$%&\'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])', $paramValue);
    }

    private function validateUrl($paramValue): bool
    {
        return preg_match('https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)', $paramValue);
    }

    private function validateDate($paramValue, $format = 'Y-m-d')
    {
        $date = DateTime::createFromFormat($format, $paramValue);
        return $date && $date->format($format) == $paramValue;
    }


}