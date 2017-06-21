<?php

namespace AppBundle\Validator\Constraints;

use AppBundle\Entity\WineryRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class WineryExistsValidator
 *
 * @package AppBundle\Validator\Constraints
 */
class WineryExistsValidator extends ConstraintValidator
{
    /**
     * @var WineryRepository
     */
    private $wineryRepository;

    /**
     * WineryExistsValidator constructor.
     *
     * @param WineryRepository $wineryRepository
     */
    public function __construct(
        WineryRepository $wineryRepository
    ) {
        $this->wineryRepository = $wineryRepository;
    }

    /**
     * Checks if the passed value is valid.
     *
     * @param mixed      $value      The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     */
    public function validate($value, Constraint $constraint)
    {
        if (null === $this->wineryRepository->find($value)) {
            $this->context->addViolation($constraint->message, ['{{ id }}' => $value]);
        }
    }
}