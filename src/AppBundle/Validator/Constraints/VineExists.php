<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Class VineExists
 *
 * @package AppBundle\Validator\Constraints\VineExists
 *
 */
class VineExists extends Constraint
{
    public $message = 'id {{ id }} not found.';

    /**
     * @return string
     */
    public function validatedBy()
    {
        return 'vine_exists_validator';
    }
}