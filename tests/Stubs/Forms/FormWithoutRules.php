<?php

namespace Tests\Stubs\Forms;

use \Validator\Forms\AbstractForm;

class FormWithoutRules extends AbstractForm
{
    public $name;
    public $surName;
    public $thirdName;
    public $age;
}