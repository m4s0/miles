<?php

namespace AppBundle\Entity;

/**
 * Winery
 */
class Winery
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
    private $city;

    /**
     * @var string
     */
    private $region;

    /**
     * @var string
     */
    private $country;

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
     * Get city
     *
     * @return string
     */
    public function city(): string
    {
        return $this->city;
    }

    /**
     * Get region
     *
     * @return string
     */
    public function region(): string
    {
        return $this->region;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function country(): string
    {
        return $this->country;
    }

    /**
     * @param $name
     * @param $city
     * @param $region
     * @param $country
     *
     * @return Winery
     */
    public static function create($name, $city, $region, $country): Winery
    {
        $winery = new self();

        $winery->name = $name;
        $winery->city = $city;
        $winery->region = $region;
        $winery->country = $country;

        return $winery;
    }
}

