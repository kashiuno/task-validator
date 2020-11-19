<?php

namespace Tests\Stubs\Forms;

use Validator\Validators\RegExpValidator;

class FormWithInvalidSpecifiedRule extends FormWithoutRules
{
    public function rules()
    {
        return [
            ['nam' => new RegExpValidator('Rule not compatible', ['expression' => '/adew/'])],
        ];
    }
}