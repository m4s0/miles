<?php

namespace AppBundle\Validator\Constraints;

use AppBundle\Entity\VineRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class VineExistsValidator
 *
 * @package AppBundle\Validator\Constraints
 */
class VineExistsValidator extends ConstraintValidator
{
    /**
     * @var VineRepository
     */
    private $vineRepository;

    /**
     * VineExistsValidator constructor.
     *
     * @param VineRepository $vineRepository
     */
    public function __construct(
        VineRepository $vineRepository
    ) {
        $this->vineRepository = $vineRepository;
    }

    /**
     * Checks if the passed value is valid.
     *
     * @param mixed      $value      The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     */
    public function validate($value, Constraint $constraint)
    {
        if (null === $this->vineRepository->find($value)) {
            $this->context->addViolation($constraint->message, ['{{ id }}' => $value]);
        }
    }
}