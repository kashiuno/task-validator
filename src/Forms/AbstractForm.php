<?php

namespace Validator\Forms;

use ReflectionClass;
use Validator\Exceptions\ValidateConfigurationException;

abstract class AbstractForm
{
    private ReflectionClass $ownMetadata;
    private array $errors;

    public function __construct()
    {
        $this->ownMetadata = new ReflectionClass($this);
        $this->errors = [];
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function rules()
    {
        return [];
    }

    public function validate(): bool
    {
        $rules = $this->rules();
        foreach ($rules as $rule) {
            if (!is_array($rule)) {
                throw new ValidateConfigurationException('Rules is not valid');
            }
            foreach ($rule as $field => $validator) {
                $this->checkExistProperty($field);

                $validateResult = $validator($this->$field);

                if (!empty($validateResult)) {
                    $this->errors[$field][] = $validateResult;
                }
            }
        }

        return $this->errors === [];
    }

    protected function checkExistProperty(string $property)
    {
        if (!$this->ownMetadata->hasProperty($property)) {
            throw new ValidateConfigurationException("Property $property not found!");
        }
    }

    public function load(array $values)
    {
        foreach ($values as $propertyName => $propertyValue) {
            if ($this->ownMetadata->hasProperty($propertyName)) {
                $this->$propertyName = $propertyValue;
            }
        }
    }
}