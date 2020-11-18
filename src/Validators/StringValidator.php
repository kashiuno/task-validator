<?php

namespace Validator\Validators;

class StringValidator extends AbstractValidator
{
    protected string $message = 'Is not a string';
    public function __invoke($value): string
    {
        if (!is_string($value)) {
            return $this->message;
        }
        return '';
    }
}