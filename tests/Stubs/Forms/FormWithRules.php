<?php

namespace Tests\Stubs\Forms;

use Validator\Validators\CallableValidator;
use Validator\Validators\RegExpValidator;
use Validator\Validators\RequireValidator;

class FormWithRules extends FormWithoutRules
{
    public function rules()
    {
        return [
            ['name' => new RegExpValidator('Specified string is not match the pattern', ['expression' => '/\\d/', 'match' => true])],
            ['name' => new RequireValidator('Name must be specify')],
            ['name' => new CallableValidator('Name not assert to callable', ['callback' => function ($value) { return is_string($value); }])],
            ['age' => new RequireValidator('Age must be specify')]
        ];
    }
}