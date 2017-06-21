<?php

namespace AppBundle\Entity;

/**
 * Vine
 */
class Vine
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $grapes;

    /**
     * Get id
     *
     * @return integer
     */
    public function id(): int
    {
        return $this->id;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * Get grapes
     *
     * @return string
     */
    public function grapes(): string
    {
        return $this->grapes;
    }

    /**
     * @param $name
     * @param $grapes
     *
     * @return Vine
     */
    public static function create($name, $grapes): Vine
    {
        $vine = new self();

        $vine->name   = $name;
        $vine->grapes = $grapes;

        return $vine;
    }
}

