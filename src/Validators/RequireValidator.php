<?php

namespace Validator\Validators;

class RequireValidator extends AbstractValidator
{
    /**
     * {@inheritdoc}
     */
    public function __invoke($value): string
    {
        if (empty($value)) {
            return $this->message;
        }

        return '';
    }
}