<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Validator\Exceptions\ValidateConfigurationException;
use Validator\Validators\RegExpValidator;

class RegExpValidatorTest extends TestCase
{
    private string $message = 'default message';

    public function testValidatorMustThrowExceptionIfConfigIsInvalid() {
        $validator = new RegExpValidator($this->message);

        try {
            $validator('123');
            self::assertFalse(true);
        } catch (ValidateConfigurationException $e) {
            self::assertTrue(true);
        }
    }

    public function testValidatorMustReturnEmptyErrorMessageOnRegExpMatchAndMatchTrueMode() {
        $validator = new RegExpValidator($this->message, ['expression' => '/\d/']);

        self::assertEquals('',$validator('1'));
    }

    public function testValidatorMustReturnErrorMessageOnRegExpMatchAndMatchFalseMode() {
        $validator = new RegExpValidator($this->message, ['expression' => '/\d/', 'match' => false]);

        self::assertEquals($this->message,$validator('1'));
    }

    public function testValidatorMustReturnErrorMessageOnRegExpNotMatchAndMatchTrueMode() {
        $validator = new RegExpValidator($this->message, ['expression' => '/\d/']);

        self::assertEquals($this->message, $validator('asd'));
    }

    public function testValidatorMustReturnEmptyErrorMessageOnRegExpNotMatchAndMatchFalseMode() {
        $validator = new RegExpValidator($this->message, ['expression' => '/\d/', 'match' => false]);

        self::assertEquals('', $validator('asd'));
    }
}