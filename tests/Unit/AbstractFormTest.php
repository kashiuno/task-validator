<?php

namespace Tests\Unit;

use Tests\Stubs\Forms\FormWithInvalidArrayRules;
use Tests\Stubs\Forms\FormWithInvalidSpecifiedRule;
use Tests\Stubs\Forms\FormWithoutRules;
use Tests\Stubs\Forms\FormWithRules;
use Validator\Exceptions\ValidateConfigurationException;
use \PHPUnit\Framework\TestCase;

final class AbstractFormTest extends TestCase
{
    private string $name = 'Petya';
    private string $surName = 'Krupin';
    private string $thirdName = 'Alexeevich';
    private int $age = 23;

    public function testFormMustLoadData() {
        $form = new FormWithoutRules();
        $form->load(['name' => $this->name, 'surName' => $this->surName, 'thirdName' => $this->thirdName, 'age' => $this->age]);

        $this->assertEquals($form->name, $this->name);
        $this->assertEquals($form->surName, $this->surName);
        $this->assertEquals($form->thirdName, $this->thirdName);
        $this->assertEquals($form->age, $this->age);
    }

    public function testFormMustLoadParticularData() {
        $form = new FormWithoutRules();
        $form->load(['name' => $this->name, 'surName' => $this->surName]);

        $this->assertEquals($form->name, $this->name);
        $this->assertEquals($form->surName, $this->surName);
        $this->assertFalse(isset($form->thirdName));
        $this->assertFalse(isset($form->age));
    }

    public function testFormMustIgnoreOtherFields() {
        $form = new FormWithoutRules();
        $form->load(['name' => $this->name, 'surName' => $this->surName, 'notExistenceField' => 'Not Exist']);

        $this->assertEquals($form->name, $this->name);
        $this->assertEquals($form->surName, $this->surName);
        $this->assertObjectNotHasAttribute('notExistenceField', $form);
    }

    public function testFormRulesMustReturnEmptyArrayIfRulesNotSpecify() {
        $form = new FormWithoutRules();

        self::assertEmpty($form->rules());
    }

    public function testFormGetErrorsMustReturnEmptyArrayBeforeValidation() {
        $form = new FormWithoutRules();

        self::assertEmpty($form->getErrors());
    }

    public function testFormGetErrorsMustReturnEmptyArrayAfterValidationIfRulesNotSpecified() {
        $form = new FormWithoutRules();

        $form->validate();

        self::assertEmpty($form->getErrors());
    }

    public function testFormValidateMustReturnTrueIfRulesNotSpecify() {
        $form = new FormWithoutRules();

        $this->assertTrue($form->validate());
    }

    public function testFormValidateMustReturnFalseIfValidateFailed() {
        $form = new FormWithRules();

        $form->load(['name' => $this->name, 'surName' => $this->surName, 'thirdName' => $this->thirdName, 'age' => $this->age]);

        $this->assertFalse($form->validate());
    }

    public function testFormGetErrorsMustReturnNotEmptyArrayIfValidateFailed() {
        $form = new FormWithRules();

        $form->load(['name' => $this->name, 'surName' => $this->surName, 'thirdName' => $this->thirdName, 'age' => $this->age]);

        $form->validate();

        $this->assertTrue($form->getErrors() !== []);
    }

    public function testFormValidateMustThrowExceptionIfFieldInRuleNotExist() {
        $form = new FormWithInvalidSpecifiedRule();

        try {
            $form->validate();
            $this->assertTrue(false);
        } catch (ValidateConfigurationException $e) {
            $this->assertTrue(true);
        }
    }

    public function testFormGetFieldsMustContainFewMessagesOnOneField() {
        $form = new FormWithRules();

        $form->load(['name' => '']);

        $form->validate();

        self::assertCount(2, $form->getErrors()['name']);
    }

    public function testFormValidateMustThrowValidateConfigurationExceptionIfRulesArrayInvalid() {
        $form = new FormWithInvalidArrayRules();

        try {
            $form->validate();
            $this->assertTrue(false);
        } catch (ValidateConfigurationException $e) {
            $this->assertTrue(true);
        }
    }
}