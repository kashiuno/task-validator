<?php

namespace Validator\Validators;

use Validator\Exceptions\ValidateConfigurationException;

class StringValidator extends AbstractValidator
{
    protected string $message = 'Is not a string';
    public function __invoke($value): string
    {
        if ($this->isStrict() && !is_string($value)) {
            return $this->message;
        }
        return '';
    }

    protected function validateConfig()
    {
        if (isset($this->parameters['strict']) && !is_bool($this->parameters['strict'])) throw new ValidateConfigurationException('Parameter strict must be a boolean');
    }

    private function isStrict() {
        return isset($this->parameters['strict']) && $this->parameters['strict'];
    }
}