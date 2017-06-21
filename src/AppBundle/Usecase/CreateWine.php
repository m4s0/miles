<?php

namespace AppBundle\Usecase;

use AppBundle\DTO\WineDTO;
use AppBundle\Entity\VineRepository;
use AppBundle\Entity\Wine;
use AppBundle\Entity\WineRepository;
use AppBundle\Entity\WineryRepository;
use AppBundle\Exception\DomainException;
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
     * @var WineRepository
     */
    private $wineRepository;
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
     * @param WineRepository     $wineRepository
     * @param WineryRepository   $wineryRepository
     * @param VineRepository     $vineRepository
     * @param EntityManager      $entityManager
     */
    public function __construct(
        ValidatorInterface $validator,
        WineRepository $wineRepository,
        WineryRepository $wineryRepository,
        VineRepository $vineRepository,
        EntityManager $entityManager
    ) {
        $this->validator        = $validator;
        $this->wineRepository   = $wineRepository;
        $this->wineryRepository = $wineryRepository;
        $this->vineRepository   = $vineRepository;
        $this->entityManager    = $entityManager;
    }

    /**
     * @param WineDTO $wineDTO
     *
     * @return array
     * @throws \AppBundle\Exception\DomainException
     */
    public function execute(WineDTO $wineDTO): array
    {
        $errors = $this->validator->validate($wineDTO);
        if (count($errors) > 0) {
            throw DomainException::create($errors);
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