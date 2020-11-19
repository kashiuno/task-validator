<?php

namespace Validator\Validators;

use Validator\Exceptions\ValidateConfigurationException;

class ObjectTypeValidator extends AbstractValidator
{
    public function __invoke($value): string
    {
        $this->validateConfig();
        if ($this->checkPrimitives($value)) return '';
        if (!($value instanceof $this->parameters['type'])) return $this->message;
        return '';
    }

    protected function validateConfig() {
        if (!isset($this->parameters['type'])) throw new ValidateConfigurationException('Type must be specified');
        else if (!is_string($this->parameters['type'])) throw new ValidateConfigurationException('Type must be a string type');
    }

    private function checkPrimitives($value) {
        switch ($this->parameters['type']) {
            case 'string':
                return is_string($value);
            case 'boolean':
                return is_bool($value);
            case 'integer':
                return is_integer($value);
            case 'array':
                return is_array($value);
            case 'null':
                return is_null($value);
            case 'callable':
                return is_callable($value);
            case 'double':
                return is_double($value);
            case 'descriptor':
                return is_resource($value);
            default:
                return false;
        }
    }
}