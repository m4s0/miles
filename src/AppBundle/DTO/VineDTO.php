<?php

namespace AppBundle\DTO;

/**
 * Class VineDTO
 *
 * @package AppBundle\DTO
 */
class VineDTO
{
    public $name;
    public $grapes;

    /**
     * @param $data
     *
     * @return VineDTO
     */
    public static function create($data): VineDTO
    {
        $vineDTO = new self();

        $vineDTO->name   = $data['name']??null;
        $vineDTO->grapes = $data['grapes']??null;

        return $vineDTO;
    }
}