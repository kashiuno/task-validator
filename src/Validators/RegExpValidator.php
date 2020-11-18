<?php

namespace Validator\Validators;

use Validator\Exceptions\ValidateConfigurationException;

class RegExpValidator extends AbstractValidator
{
    protected string $message = 'Value is not match a pattern';

    public function __invoke($value): string
    {
        $this->validateConfig();
        var_dump(preg_match($this->parameters['expression'], $value));
        if (!is_string($value))
        {
            return $this->message;
        }
        if ((preg_match($this->parameters['expression'], $value) xor $this->isMatch())){
            return $this->message;
        }
        return '';
    }

    protected function validateConfig() {
        if (!is_array($this->parameters)) throw new ValidateConfigurationException('Config must be an array');
        if (!isset($this->parameters['expression'])) throw new ValidateConfigurationException('Expression must be specify');
    }

    private function isMatch() {
        return isset($this->parameters['match']) ? $this->parameters['match'] : true;
    }
}