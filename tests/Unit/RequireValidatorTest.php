<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Validator\Validators\RequireValidator;

class RequireValidatorTest extends TestCase
{
    private string $message = 'default message';

    public function testValidatorMustReturnEmptyMessageIfFieldFilled() {
        $validator = new RequireValidator($this->message);

        self::assertEquals('', $validator('asd'));
    }

    public function testValidatorMustReturnNotEmptyErrorMessageIfFieldEmpty() {
        $validator = new RequireValidator($this->message);

        self::assertEquals($this->message, $validator(''));
    }

    public function testValidatorMustReturnNotEmptyErrorMessageIfFieldNull() {
        $validator = new RequireValidator($this->message);

        self::assertEquals($this->message, $validator(null));
    }
}