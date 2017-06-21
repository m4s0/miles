<?php

namespace AppBundle\Exception;

use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Class DomainException
 *
 * @package AppBundle\Exception
 */
class DomainException extends \DomainException
{
    /**
     * @var ConstraintViolationListInterface
     */
    protected $errors;

    /**
     * @return array
     */
    public function getErrors(): array
    {
        $errors = [];
        /** @var ConstraintViolation $error */
        foreach ($this->errors as $error) {
            $errors[$error->getPropertyPath()] = $error->getMessage();
        }

        return [
            'errors' => $errors
        ];
    }

    /**
     * @param ConstraintViolationListInterface $errors
     *
     * @return DomainException
     */
    public static function create(ConstraintViolationListInterface $errors)
    {
        $domainException = new self();

        $domainException->errors = $errors;

        return $domainException;
    }
}