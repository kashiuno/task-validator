# Validator project for test task.

### Install and requirements

Package published on packagist. You may install it by composer.

Command: composer require kashiuno/task-validator:dev-master

Package require php7.4 or later.

### Using

You may use validators on classes which extends the AbstractForm class.

##### 1. Specify rules:

When you extend AbstractForm class you may override rules() method which must return array with rules

Example:

    public function rules(): array
    {
        return [
            [
                'name' => new RegExpValidator(
                    'Specified string is not match the pattern',
                    ['expression' => '/\\d/', 'match' => true]
                ),
            ],
            ['name' => new RequireValidator('Name must be specify')],
            [
                'name' => new CallableValidator(
                    'Name not assert to callable', [
                    'callback' => function ($value) {
                        return is_string($value);
                    },
                ]
                ),
            ],
            ['age' => new RequireValidator('Age must be specify')],
        ];
    }

Notice: your form class must contain the fields specified in rules

##### 2. Using in client side

After instantiating form you may run load() method to initialize fields from array

Each element of array must have key equals the field name, other array keys should ignore

Example:

    $form = new Form();
    $form->load(['name' => 'John', 'surName' => 'Moore', 'age' => 24]);

Then you run method validate() that run all validate rules which returned by rules() method. validate() method return true or false

You may run the getErrors() method to get validation errors

    $form = new Form();
    $form->validate();
    $form->getErrors();
    
##### 3. Validators

All validators may accept error message and configuration assoc array

###### Callable validator config
['callback' => Callable]
Callback is mandatory

Example:

     $validator = new CallableValidator('message', ['callback' => fn ($value) => is_string($value)]);
     
###### RegExp validator config
['expression' => string, 'match' => bool]
Expression is mandatory

Example:

    $validator = new RegExpValidator('message', ['expression' => '/\d/', match => false]);
    
Match parameter meaning should the string match the expression

###### Require validator
requireValidator don't have config
Example:

    $validator = new RequireValidator('message');
    
###### String validator
['strict' => bool]

Example:

    $validator = new StringValidator($this->message, ['strict' => true]);
    
If strict parameter specified validator check strict type of value else don't check and pass