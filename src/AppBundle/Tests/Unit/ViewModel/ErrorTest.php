<?php
use AppBundle\Exception\ValidationException;
use AppBundle\ViewModel\Error;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;

class ErrorTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     * @covers \AppBundle\ViewModel\Error::serialize()
     */
    public function should_get_serialize()
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

        $error = Error::create('Validation failed.', $domainException->errors());

        $errorSerialized = $error->serialize();
        $this->assertArrayHasKey('message', $errorSerialized);
        $this->assertEquals('Validation failed.', $errorSerialized['message']);

        $this->assertArrayHasKey('errors', $errorSerialized);
        $this->assertArrayHasKey('name', $errorSerialized['errors']);
        $this->assertEquals('This value should not be null.', $errorSerialized['errors']['name']);
        $this->assertArrayHasKey('year', $errorSerialized['errors']);
        $this->assertEquals('This value is not valid.', $errorSerialized['errors']['year']);
    }
}