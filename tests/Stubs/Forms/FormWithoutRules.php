<?php

namespace Tests\Stubs\Forms;

use \Validator\Forms\AbstractForm;

class FormWithoutRules extends AbstractForm
{
    public string $name;
    public string $surName;
    public string $thirdName;
    public int $age;
}