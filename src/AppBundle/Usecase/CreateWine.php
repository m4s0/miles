<?php

namespace AppBundle\Usecase;

use AppBundle\DTO\WineDTO;
use AppBundle\Entity\VineRepository;
use AppBundle\Entity\Wine;
use AppBundle\Entity\WineryRepository;
use AppBundle\Exception\ValidationException;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class CreateWine
 *
 * @package AppBundle\Usecase
 */
class CreateWine
{
    /**
     * @var ValidatorInterface
     */
    private $validator;
    /**
     * @var WineryRepository
     */
    private $wineryRepository;
    /**
     * @var VineRepository
     */
    private $vineRepository;
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * CreateWine constructor.
     *
     * @param ValidatorInterface $validator
     * @param WineryRepository   $wineryRepository
     * @param VineRepository     $vineRepository
     * @param EntityManager      $entityManager
     */
    public function __construct(
        ValidatorInterface $validator,
        WineryRepository $wineryRepository,
        VineRepository $vineRepository,
        EntityManager $entityManager
    ) {
        $this->validator        = $validator;
        $this->wineryRepository = $wineryRepository;
        $this->vineRepository   = $vineRepository;
        $this->entityManager    = $entityManager;
    }

    /**
     * @param WineDTO $wineDTO
     *
     * @return array
     * @throws \AppBundle\Exception\ValidationException
     */
    public function execute(WineDTO $wineDTO): array
    {
        $errors = $this->validator->validate($wineDTO);
        if (count($errors) > 0) {
            throw ValidationException::create($errors);
        }

        $wine = Wine::create(
            $wineDTO->name,
            $wineDTO->price,
            $wineDTO->year,
            $this->wineryRepository->find($wineDTO->wineryId),
            $this->vineRepository->find($wineDTO->vineId)
        );

        $this->entityManager->persist($wine);
        $this->entityManager->flush();

        return [
            'id' => $wine->id()
        ];
    }
}