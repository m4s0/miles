<?php

namespace AppBundle\Exception;

/**
 * Class DomainException
 *
 * @package AppBundle\Exception
 */
class DomainException extends \DomainException
{
    /**
     * @var string
     */
    protected $message;

    /**
     * @return string
     */
    public function message(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     *
     * @return DomainException
     */
    public static function create(string $message): DomainException
    {
        $domainException = new self();

        $domainException->message = $message;

        return $domainException;
    }

}