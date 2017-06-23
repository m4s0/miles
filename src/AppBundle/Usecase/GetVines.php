<?php

namespace AppBundle\Usecase;

use AppBundle\Entity\Vine;
use AppBundle\Entity\VineRepository;

/**
 * Class GetVines
 *
 * @package AppBundle\Usecase
 */
class GetVines
{
    /**
     * @var VineRepository
     */
    private $vineRepository;

    /**
     * GetVines constructor.
     *
     * @param VineRepository $vineRepository
     */
    public function __construct(
        VineRepository $vineRepository
    ) {
        $this->vineRepository = $vineRepository;
    }

    /**
     * @return array
     */
    public function execute(): array
    {
        $vines = $this->vineRepository->findAll();

        $data = [];
        /** @var Vine $vine */
        foreach ($vines as $vine) {
            $data[] = [
                'id'     => $vine->id(),
                'name'   => $vine->name(),
                'grapes' => $vine->grapes(),
            ];
        }

        return $data;
    }
}