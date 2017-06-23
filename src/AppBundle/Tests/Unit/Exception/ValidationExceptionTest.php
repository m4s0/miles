<?php

use AppBundle\Exception\ValidationException;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;

class ValidationExceptionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     * @covers ValidationException::errors()
     */
    public function i_should_get_errors()
    {
        $violationList = new ConstraintViolationList();

        $violations1 = $this->prophesize(ConstraintViolation::class);
        $violations1->getPropertyPath()->willReturn('name');
        $violations1->getMessage()->willReturn('This value should not be null.');

        $violations2 = $this->prophesize(ConstraintViolation::class);
        $violations2->getPropertyPath()->willReturn('year');
        $violations2->getMessage()->willReturn('This value is not valid.');

        $violationList->add($violations1->reveal());
        $violationList->add($violations2->reveal());

        $domainException = ValidationException::create($violationList);
        $errors = $domainException->errors();

        $this->assertArrayHasKey('name', $errors);
        $this->assertEquals('This value should not be null.', $errors['name']);
        $this->assertArrayHasKey('year', $errors);
        $this->assertEquals('This value is not valid.', $errors['year']);
    }
}
