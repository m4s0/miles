<?php

namespace AppBundle\Entity;

/**
 * Wine
 */
class Wine
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
     * @var integer
     */
    private $price;

    /**
     * @var string
     */
    private $year;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $rates;

    /**
     * @var \AppBundle\Entity\Winery
     */
    private $winery;

    /**
     * @var \AppBundle\Entity\Vine
     */
    private $vine;

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
     * Get price
     *
     * @return integer
     */
    public function price(): int
    {
        return $this->price;
    }

    /**
     * Get year
     *
     * @return string
     */
    public function year(): string
    {
        return $this->year;
    }

//    /**
//     * Add rate
//     *
//     * @param \AppBundle\Entity\Rate $rate
//     *
//     * @return Wine
//     */
//    public function addRate(\AppBundle\Entity\Rate $rate)
//    {
//        $this->rates[] = $rate;
//
//        return $this;
//    }
//
//    /**
//     * Remove rate
//     *
//     * @param \AppBundle\Entity\Rate $rate
//     */
//    public function removeRate(\AppBundle\Entity\Rate $rate)
//    {
//        $this->rates->removeElement($rate);
//    }

    /**
     * Get rates
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function rates(): \Doctrine\Common\Collections\Collection
    {
        return $this->rates;
    }

    /**
     * Get winery
     *
     * @return \AppBundle\Entity\Winery
     */
    public function winery(): Winery
    {
        return $this->winery;
    }

    /**
     * Get vine
     *
     * @return \AppBundle\Entity\Vine
     */
    public function vine(): Vine
    {
        return $this->vine;
    }

    /**
     * @param $name
     * @param $price
     * @param $year
     * @param $winery
     * @param $vine
     *
     * @return Wine
     */
    public static function create($name, $price, $year, $winery, $vine): Wine
    {
        $wine = new self();

        $wine->name   = $name;
        $wine->price  = $price;
        $wine->year   = $year;
        $wine->winery = $winery;
        $wine->vine   = $vine;

        return $wine;
    }
}
