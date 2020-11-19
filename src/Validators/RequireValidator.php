<?php

namespace Validator\Validators;

class RequireValidator extends AbstractValidator
{
    public function __invoke($value): string
    {
        if (empty($value)) {
            return $this->message;
        }
        return '';
    }

    protected function validateConfig()
    {

    }
}