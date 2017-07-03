<?php

namespace AppBundle\Usecase;

use AppBundle\Entity\Winery;
use AppBundle\Entity\WineryRepository;
use AppBundle\Exception\DomainException;

/**
 * Class GetWinery
 *
 * @package AppBundle\Usecase
 */
class GetWinery
{
    /**
     * @var WineryRepository
     */
    private $wineryRepository;

    /**
     * GetWinery constructor.
     *
     * @param WineryRepository $wineryRepository
     */
    public function __construct(
        WineryRepository $wineryRepository
    ) {
        $this->wineryRepository = $wineryRepository;
    }

    /**
     * @param int $id
     *
     * @return array
     * @throws \AppBundle\Exception\DomainException
     */
    public function execute(int $id): array
    {
        /** @var Winery $winery */
        $winery = $this->wineryRepository->find($id);
        if (null === $winery) {
            throw DomainException::create('Winery id ' . $id . ' not found.');
        }

        return [
            'id'      => $winery->id(),
            'name'    => $winery->name(),
            'city'    => $winery->city(),
            'region'  => $winery->region(),
            'country' => $winery->country()
        ];
    }
}
