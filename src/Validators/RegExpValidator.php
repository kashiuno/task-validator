<?php

namespace Validator\Validators;

use InvalidArgumentException;
use Validator\Exceptions\ValidateConfigurationException;

class RegExpValidator extends AbstractValidator
{
    protected string $message = 'Value is not match a pattern';

    /**
     * @param $value
     *
     * @return string
     * @throws ValidateConfigurationException
     */
    public function __invoke($value): string
    {
        $this->validateConfig();
        if (!is_string($value)) {
            throw new InvalidArgumentException('Value not a string');
        }
        if (preg_match($this->parameters['expression'], $value) xor $this->isMatch()) {
            return $this->message;
        }

        return '';
    }

    /**
     * @throws ValidateConfigurationException
     */
    protected function validateConfig(): void
    {
        if (!is_array($this->parameters)) {
            throw new ValidateConfigurationException('Config must be an array');
        }
        if (!isset($this->parameters['expression'])) {
            throw new ValidateConfigurationException('Expression must be specify');
        }
    }

    /**
     * @return bool
     */
    private function isMatch(): bool
    {
        return $this->parameters['match'] ?? true;
    }
}