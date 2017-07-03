<?php

namespace AppBundle\Usecase;

use AppBundle\DTO\WineryDTO;
use AppBundle\Entity\Wine;
use AppBundle\Entity\Winery;
use AppBundle\Entity\WineryRepository;
use AppBundle\Exception\DomainException;
use AppBundle\Exception\ValidationException;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class UpdateWinery
 *
 * @package AppBundle\Usecase
 */
class UpdateWinery
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
     * @var EntityManager
     */
    private $entityManager;

    /**
     * UpdateWinery constructor.
     *
     * @param ValidatorInterface $validator
     * @param WineryRepository   $wineryRepository
     * @param EntityManager      $entityManager
     */
    public function __construct(
        ValidatorInterface $validator,
        WineryRepository $wineryRepository,
        EntityManager $entityManager
    ) {
        $this->validator        = $validator;
        $this->wineryRepository = $wineryRepository;
        $this->entityManager    = $entityManager;
    }

    /**
     * @param int       $id
     * @param WineryDTO $wineryDTO
     *
     * @return array
     * @throws \AppBundle\Exception\ValidationException
     * @throws \AppBundle\Exception\DomainException
     */
    public function execute(int $id, WineryDTO $wineryDTO): array
    {
        /** @var Winery $winery */
        $winery = $this->wineryRepository->find($id);
        if (null === $winery) {
            throw DomainException::create('Winery id ' . $id . ' not found.');
        }

        $errors = $this->validator->validate($wineryDTO);
        if (count($errors) > 0) {
            throw ValidationException::create($errors);
        }

        $winery->update($wineryDTO->name, $wineryDTO->city, $wineryDTO->region, $wineryDTO->country);

        $this->entityManager->persist($winery);
        $this->entityManager->flush();

        return [
            'id' => $winery->id()
        ];
    }
}