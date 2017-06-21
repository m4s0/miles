<?php

namespace AppBundle\Entity;

/**
 * Rate
 */
class Rate
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $rate;

    /**
     * @var \AppBundle\Entity\Wine
     */
    private $wine;

    /**
     * Get id
     *
     * @return integer
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * Get rate
     *
     * @return integer
     */
    public function rate()
    {
        return $this->rate;
    }

    /**
     * Get wine
     *
     * @return \AppBundle\Entity\Wine
     */
    public function wine()
    {
        return $this->wine;
    }
}

