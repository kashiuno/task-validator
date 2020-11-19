<?php

namespace Tests\Unit;

use \PHPUnit\Framework\TestCase;
use Validator\Exceptions\ValidateConfigurationException;
use Validator\Validators\CallableValidator;

class CallableValidatorTest extends TestCase
{
    private $message = 'default message';

    public function testValidatorMustReturnMessageIfValidationFail() {
        $validator = new CallableValidator($this->message, ['callback' => fn ($value) => is_string($value)]);

        $validationResult = $validator(123);

        self::assertEquals($this->message, $validationResult);
    }

    public function testValidatorMustReturnEmptyStringIfValidationSuccess() {
        $validator = new CallableValidator($this->message, ['callback' => fn ($value) => is_string($value)]);

        $validationResult = $validator('123');

        self::assertEquals('', $validationResult);
    }

    public function testValidatorMustThrowExceptionIfConfigIsInvalid() {
        $validator = new CallableValidator($this->message);

        try {
            $validator('123');
            self::assertFalse(true);
        } catch (ValidateConfigurationException $e) {
            self::assertTrue(true);
        }
    }
}