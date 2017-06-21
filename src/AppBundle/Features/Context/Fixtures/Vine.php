<?php

namespace AppBundle\Features\Context\Fixtures;

use Doctrine\ORM\EntityManager;

/**
 * Class Vine
 *
 * @package AppBundle\Features\Context\Fixtures
 */
class Vine
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
     * @param $grapes
     */
    public function generate($name, $grapes)
    {
        $vine = \AppBundle\Entity\Vine::create($name, $grapes);

        $this->em->persist($vine);
        $this->em->flush();
    }
}