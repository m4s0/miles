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
    public function should_get_errors()
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
        $response = $domainException->errors();

        $this->assertArrayHasKey('message', $response);
        $this->assertEquals('Validation failed.', $response['message']);
        
        $this->assertArrayHasKey('errors', $response);
        $this->assertArrayHasKey('name', $response['errors']);
        $this->assertEquals('This value should not be null.', $response['errors']['name']);
        $this->assertArrayHasKey('year', $response['errors']);
        $this->assertEquals('This value is not valid.', $response['errors']['year']);
    }
}
