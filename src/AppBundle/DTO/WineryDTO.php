<?php

namespace AppBundle\DTO;

/**
 * Class WineryDTO
 *
 * @package AppBundle\DTO
 */
class WineryDTO
{
    public $name;
    public $city;
    public $region;
    public $country;

    /**
     * @param $data
     *
     * @return WineryDTO
     */
    public static function create($data): WineryDTO
    {
        $wineryDTO = new self();

        $wineryDTO->name    = $data['name']??null;
        $wineryDTO->city    = $data['city']??null;
        $wineryDTO->region  = $data['region']??null;
        $wineryDTO->country = $data['country']??null;

        return $wineryDTO;
    }
}