<?php

namespace Validator;

use Validator\Forms\AbstractForm;
use Validator\Validators\RegExpValidator;
use Validator\Validators\StringValidator;

class Form extends AbstractForm
{
    public string $surName;
    public string $name;

    public function rules()
    {
        return [
            ['name' => new StringValidator('')],
            ['name' => new RegExpValidator('', ['expression' => '/Petya/', 'match' => true])],
        ];
    }
}