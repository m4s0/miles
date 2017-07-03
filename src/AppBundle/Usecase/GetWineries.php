<?php

namespace AppBundle\Usecase;

use AppBundle\Entity\Winery;
use AppBundle\Entity\WineryRepository;

class GetWineries
{
    /**
     * @var WineryRepository
     */
    private $wineryRepository;

    /**
     * GetWineries constructor.
     *
     * @param WineryRepository $wineryRepository
     */
    public function __construct(
        WineryRepository $wineryRepository
    ) {
        $this->wineryRepository = $wineryRepository;
    }

    /**
     * @return array
     */
    public function execute(): array
    {
        $wineries = $this->wineryRepository->findAll();

        $data = [];
        /** @var Winery $winery */
        foreach ($wineries as $winery) {
            $data[] = [
                'id'      => $winery->id(),
                'name'    => $winery->name(),
                'city'    => $winery->city(),
                'region'  => $winery->region(),
                'country' => $winery->country()
            ];
        }

        return $data;
    }
}