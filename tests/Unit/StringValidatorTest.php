<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Validator\Exceptions\ValidateConfigurationException;
use Validator\Validators\StringValidator;

class StringValidatorTest extends TestCase
{
    private string $message = 'default message';

    public function testValidatorMustThrowExceptionIfConfigIsInvalid() {
        $validator = new StringValidator($this->message, ['strict' => 1]);

        try {
            $validator('123');
            self::assertFalse(true);
        } catch (ValidateConfigurationException $e) {
            self::assertTrue(true);
        }
    }

    public function testValidatorMustReturnEmptyErrorMessageIfNotStrictMode() {
        $validator = new StringValidator($this->message, ['strict' => false]);

        self::assertEquals('', $validator('asd'));
    }

    public function testValidatorMustReturnEmptyErrorMessageIfStrictAndStringSpecified() {
        $validator = new StringValidator($this->message, ['strict' => true]);

        self::assertEquals('', $validator('asd'));
    }

    public function testValidatorMustReturnErrorMessageIfStrictModeAndValueNotString() {
        $validator = new StringValidator($this->message, ['strict' => true]);

        self::assertEquals($this->message, $validator(1));
    }
}