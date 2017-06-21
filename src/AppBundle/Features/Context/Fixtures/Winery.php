<?php

namespace AppBundle\Features\Context\Fixtures;

use Doctrine\ORM\EntityManager;

/**
 * Class Winery
 *
 * @package AppBundle\Features\Context\Fixtures
 */
class Winery
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param $name
     * @param $city
     * @param $region
     * @param $country
     */
    public function generate($name, $city, $region, $country)
    {
        $vine = \AppBundle\Entity\Winery::create($name, $city, $region, $country);

        $this->em->persist($vine);
        $this->em->flush();
    }
}