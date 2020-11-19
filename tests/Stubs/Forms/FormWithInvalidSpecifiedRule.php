<?php

namespace Tests\Stubs\Forms;

use Validator\Validators\RegExpValidator;

class FormWithInvalidSpecifiedRule extends FormWithoutRules
{
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            ['nam' => new RegExpValidator('Rule not compatible', ['expression' => '/adew/'])],
        ];
    }
}