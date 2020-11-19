<?php

namespace Validator\Forms;

use ReflectionClass;
use ReflectionException;
use Validator\Exceptions\ValidateConfigurationException;

abstract class AbstractForm
{
    private ReflectionClass $ownMetadata;
    private array $errors;

    /**
     * AbstractForm constructor.
     *
     * @throws ReflectionException
     */
    public function __construct()
    {
        $this->ownMetadata = new ReflectionClass($this);
        $this->errors = [];
    }

    /**
     * @return string[]
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * @return bool
     * @throws ValidateConfigurationException
     */
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

    /**
     * @param string $property
     *
     * @throws ValidateConfigurationException
     */
    protected function checkExistProperty(string $property)
    {
        if (!$this->ownMetadata->hasProperty($property)) {
            throw new ValidateConfigurationException("Property $property not found!");
        }
    }

    /**
     * @param array $values
     */
    public function load(array $values)
    {
        foreach ($values as $propertyName => $propertyValue) {
            if ($this->ownMetadata->hasProperty($propertyName)) {
                $this->$propertyName = $propertyValue;
            }
        }
    }
}