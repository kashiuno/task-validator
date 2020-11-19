<?php

namespace Validator\Validators;

abstract class AbstractValidator
{
    protected array $parameters;
    protected string $message = 'Error';

    /**
     * AbstractValidator constructor.
     *
     * @param string $message
     * @param array $parameters
     */
    public function __construct(string $message, array $parameters = [])
    {
        $this->parameters = $parameters;
        $this->message = empty($message) ? $this->message : $message;
    }

    /**
     * @param $value
     *
     * @return string
     */
    public abstract function __invoke($value): string;

    protected function validateConfig(): void
    {
    }
}