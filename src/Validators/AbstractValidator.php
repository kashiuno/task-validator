<?php

namespace Validator\Validators;

abstract class AbstractValidator
{
    protected array $parameters;
    protected string $message = 'Error';

    public function __construct(string $message, array $parameters = [])
    {
        $this->parameters = $parameters;
        $this->message = empty($message) ? $this->message : $message;
    }

    public abstract function __invoke($value): string;

    protected function validateConfig()
    {
    }
}