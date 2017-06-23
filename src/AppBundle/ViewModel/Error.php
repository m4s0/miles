<?php

namespace AppBundle\ViewModel;

/**
 * Class Error
 *
 * @package AppBundle\ViewModel
 */
class Error
{
    /**
     * @var string
     */
    protected $message;
    /**
     * @var array
     */
    protected $errors;

    /**
     * @return array
     */
    public function serialize(): array
    {
        $value['message'] = $this->message;

        if (!empty($this->errors)) {
            $value['errors'] = $this->errors;
        }

        return $value;
    }

    /**
     * @param string $message
     * @param array  $errors
     *
     * @return Error
     */
    public static function create(string $message, array $errors = []): Error
    {
        $error = new self();

        $error->message = $message;
        $error->errors  = $errors;

        return $error;
    }
}