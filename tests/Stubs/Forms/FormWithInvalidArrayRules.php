<?php

namespace Tests\Stubs\Forms;

use Validator\Validators\StringValidator;

class FormWithInvalidArrayRules extends FormWithoutRules
{
    public function rules()
    {
        return [
            'name' => new StringValidator('Message'),
        ];
    }
}