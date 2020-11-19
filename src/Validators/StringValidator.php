<?php

namespace Validator\Validators;

use Validator\Exceptions\ValidateConfigurationException;

class StringValidator extends AbstractValidator
{
    protected string $message = 'Is not a string';

    /**
     * @param $value
     *
     * @return string
     * @throws ValidateConfigurationException
     */
    public function __invoke($value): string
    {
        $this->validateConfig();
        if ($this->isStrict() && !is_string($value)) {
            return $this->message;
        }

        return '';
    }

    /**
     * @throws ValidateConfigurationException
     */
    protected function validateConfig(): void
    {
        if (isset($this->parameters['strict']) && !is_bool($this->parameters['strict'])) {
            throw new ValidateConfigurationException('Parameter strict must be a boolean');
        }
    }

    /**
     * @return bool
     */
    private function isStrict(): bool
    {
        return isset($this->parameters['strict']) && $this->parameters['strict'];
    }
}