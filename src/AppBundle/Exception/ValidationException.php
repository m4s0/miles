<?php

namespace AppBundle\Exception;

use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Class ValidationException
 *
 * @package AppBundle\Exception
 */
class ValidationException extends \DomainException
{
    /**
     * @var ConstraintViolationListInterface
     */
    protected $violationList;
    /**
     * @var array
     */
    protected $errors = [];
    /**
     * @var string
     */
    protected $message;

    /**
     * @return array
     */
    public function errors(): array
    {
        /** @var ConstraintViolationInterface $violation */
        foreach ($this->violationList as $violation) {
            $this->errors[$violation->getPropertyPath()] = $violation->getMessage();
        }

        return $this->errors;
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return $this->message;
    }

    /**
     * @param ConstraintViolationListInterface $violationList
     * @param string                           $message
     *
     * @return ValidationException
     */
    public static function create(ConstraintViolationListInterface $violationList, string $message = 'Validation failed.'): ValidationException
    {
        $validationException = new self();

        $validationException->message = $message;
        $validationException->violationList = $violationList;

        return $validationException;
    }
}