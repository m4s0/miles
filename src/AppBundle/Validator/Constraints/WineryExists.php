<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Class WineryExists
 *
 * @package AppBundle\Validator\Constraints\VineExists
 *
 */
class WineryExists extends Constraint
{
    public $message = 'id {{ id }} not found.';

    /**
     * @return string
     */
    public function validatedBy()
    {
        return 'winery_exists_validator';
    }
}