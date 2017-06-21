<?php

namespace AppBundle\DTO;

/**
 * Class WineDTO
 *
 * @package AppBundle\DTO
 */
class WineDTO
{
    public $name;
    public $year;
    public $price;
    public $wineryId;
    public $vineId;

    /**
     * @param $data
     *
     * @return WineDTO
     */
    public static function create($data): WineDTO
    {
        $wineDTO = new self();

        $wineDTO->name     = $data['name']??null;
        $wineDTO->year     = $data['year']??null;
        $wineDTO->price    = $data['price']??null;
        $wineDTO->wineryId = $data['wineryId']??null;
        $wineDTO->vineId   = $data['vineId']??null;

        return $wineDTO;
    }
}