<?php

namespace AppBundle\Usecase;

use AppBundle\Entity\Vine;
use AppBundle\Entity\VineRepository;
use AppBundle\Exception\DomainException;

/**
 * Class GetVine
 *
 * @package AppBundle\Usecase
 */
class GetVine
{
    /**
     * @var VineRepository
     */
    private $vineRepository;

    /**
     * GetVine constructor.
     *
     * @param VineRepository $vineRepository
     */
    public function __construct(
        VineRepository $vineRepository
    ) {
        $this->vineRepository = $vineRepository;
    }

    /**
     * @param int $id
     *
     * @return array
     * @throws \AppBundle\Exception\DomainException
     */
    public function execute(int $id)
    {
        /** @var Vine $vine */
        $vine = $this->vineRepository->find($id);
        if (null === $vine) {
            throw DomainException::create('Vine id ' . $id . ' not found.');
        }

        $data = [
            'id'     => $vine->id(),
            'name'   => $vine->name(),
            'grapes' => $vine->grapes(),
        ];

        return $data;
    }
}