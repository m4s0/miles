<?php

namespace AppBundle\Usecase;

use AppBundle\Entity\Rate;
use AppBundle\Entity\Wine;
use AppBundle\Entity\WineRepository;
use AppBundle\Exception\DomainException;

/**
 * Class GetWine
 *
 * @package AppBundle\Usecase
 */
class GetWine
{
    /**
     * @var WineRepository
     */
    private $wineRepository;

    /**
     * GetWine constructor.
     *
     * @param WineRepository $wineryRepository
     */
    public function __construct(
        WineRepository $wineryRepository
    ) {
        $this->wineRepository = $wineryRepository;
    }

    /**
     * @param int $id
     *
     * @return array
     * @throws \AppBundle\Exception\DomainException
     */
    public function execute(int $id): array
    {
        /** @var Wine $wine */
        $wine = $this->wineRepository->find($id);
        if (null === $wine) {
            throw DomainException::create('Wine id ' . $id . ' not found.');
        }

        $rates = 0;
        /** @var Rate $rate */
        foreach ($wine->rates() as $rate) {
            $rates += null !== $rate ? $rate->rate() : null;
        }

        $data = [
            'name'   => $wine->name(),
            'price'  => $wine->price(),
            'year'   => $wine->year(),
            'vine'   => [
                'id'     => $wine->vine()->id(),
                'name'   => $wine->vine()->name(),
                'grapes' => $wine->vine()->grapes(),
            ],
            'winery' => [
                'id'      => $wine->winery()->id(),
                'name'    => $wine->winery()->name(),
                'city'    => $wine->winery()->city(),
                'region'  => $wine->winery()->region(),
                'country' => $wine->winery()->country(),
            ],
            'rates'   => $rates,
        ];

        return $data;
    }
}