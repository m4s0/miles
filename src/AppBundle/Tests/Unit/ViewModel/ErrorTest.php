<?php

use AppBundle\ViewModel\Error;

class ErrorTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     * @covers \AppBundle\ViewModel\Error::serialize()
     */
    public function i_should_get_serialized_errors_and_message()
    {
        $errors = [
            'name' => 'This value should not be null.',
            'year' => 'This value is not valid.'
        ];

        $error = Error::create('Validation failed.', $errors);

        $errorSerialized = $error->serialize();

        $this->assertArrayHasKey('message', $errorSerialized);
        $this->assertEquals('Validation failed.', $errorSerialized['message']);

        $this->assertArrayHasKey('errors', $errorSerialized);
        $this->assertArrayHasKey('name', $errorSerialized['errors']);
        $this->assertEquals('This value should not be null.', $errorSerialized['errors']['name']);
        $this->assertArrayHasKey('year', $errorSerialized['errors']);
        $this->assertEquals('This value is not valid.', $errorSerialized['errors']['year']);
    }

    /**
     * @test
     * @covers \AppBundle\ViewModel\Error::serialize()
     */
    public function i_should_get_serialized_message()
    {
        $error = Error::create('Validation failed.');

        $errorSerialized = $error->serialize();

        $this->assertArrayHasKey('message', $errorSerialized);
        $this->assertEquals('Validation failed.', $errorSerialized['message']);

        $this->assertArrayNotHasKey('errors', $errorSerialized);
    }
}