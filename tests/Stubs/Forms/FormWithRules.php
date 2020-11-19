<?php

namespace Tests\Stubs\Forms;

use Validator\Validators\RegExpValidator;
use Validator\Validators\RequireValidator;

class FormWithRules extends FormWithoutRules
{
    public function rules()
    {
        return [
            ['name' => new RegExpValidator('Specified string is not match the pattern', ['expression' => '/\\d/', 'match' => true])],
            ['name' => new RequireValidator('Name must be specify')],
        ];
    }
}