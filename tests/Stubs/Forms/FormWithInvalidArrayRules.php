<?php

namespace Tests\Stubs\Forms;

use Validator\Validators\StringValidator;

class FormWithInvalidArrayRules extends FormWithoutRules
{
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            'name' => new StringValidator('Message'),
        ];
    }
}