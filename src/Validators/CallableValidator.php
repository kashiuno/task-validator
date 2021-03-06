<?php

namespace Validator\Validators;

use Validator\Exceptions\ValidateConfigurationException;

class CallableValidator extends AbstractValidator
{
    /**
     * @param $value
     *
     * @return string
     * @throws ValidateConfigurationException
     */
    public function __invoke($value): string
    {
        $this->validateConfig();

        return $this->parameters['callback']($value) ? '' : $this->message;
    }

    /**
     * @throws ValidateConfigurationException
     */
    protected function validateConfig(): void
    {
        if (!isset($this->parameters['callback'])) {
            throw new ValidateConfigurationException('Callback must be specify');
        }
        if (!is_callable($this->parameters['callback'])) {
            throw new ValidateConfigurationException('Type of callback must be callable');
        }
    }
}