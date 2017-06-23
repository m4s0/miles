<?php

namespace AppBundle\Usecase;

use AppBundle\DTO\WineryDTO;
use AppBundle\Entity\Winery;
use AppBundle\Exception\ValidationException;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class CreateWinery
 *
 * @package AppBundle\Usecase
 */
class CreateWinery
{
    /**
     * @var ValidatorInterface
     */
    private $validator;
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * CreateWinery constructor.
     *
     * @param ValidatorInterface $validator
     * @param EntityManager      $entityManager
     */
    public function __construct(
        ValidatorInterface $validator,
        EntityManager $entityManager
    ) {
        $this->validator     = $validator;
        $this->entityManager = $entityManager;
    }

    /**
     * @param WineryDTO $wineryDTO
     *
     * @return array
     * @throws \AppBundle\Exception\ValidationException
     */
    public function execute(WineryDTO $wineryDTO): array
    {
        $errors = $this->validator->validate($wineryDTO);
        if (count($errors) > 0) {
            throw ValidationException::create($errors);
        }

        $winery = Winery::create($wineryDTO->name, $wineryDTO->city, $wineryDTO->region, $wineryDTO->country);

        $this->entityManager->persist($winery);
        $this->entityManager->flush();

        return [
            'id' => $winery->id()
        ];
    }
}