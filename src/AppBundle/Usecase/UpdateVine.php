<?php

namespace AppBundle\Usecase;

use AppBundle\DTO\VineDTO;
use AppBundle\Entity\Vine;
use AppBundle\Entity\VineRepository;
use AppBundle\Exception\DomainException;
use AppBundle\Exception\ValidationException;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class UpdateVine
 *
 * @package AppBundle\Usecase
 */
class UpdateVine
{
    /**
     * @var ValidatorInterface
     */
    private $validator;
    /**
     * @var VineRepository
     */
    private $vineRepository;
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * UpdateVine constructor.
     *
     * @param ValidatorInterface $validator
     * @param VineRepository     $vineRepository
     * @param EntityManager      $entityManager
     */
    public function __construct(
        ValidatorInterface $validator,
        VineRepository $vineRepository,
        EntityManager $entityManager
    ) {
        $this->validator      = $validator;
        $this->entityManager  = $entityManager;
        $this->vineRepository = $vineRepository;
    }

    /**
     * @param int     $id
     * @param VineDTO $vineDTO
     *
     * @return array
     * @throws \AppBundle\Exception\ValidationException
     * @throws \AppBundle\Exception\DomainException
     */
    public function execute(int $id, VineDTO $vineDTO)
    {
        /** @var Vine $vine */
        $vine = $this->vineRepository->find($id);
        if (null === $vine) {
            throw DomainException::create('Vine id ' . $id . ' not found.');
        }

        $errors = $this->validator->validate($vineDTO);
        if (count($errors) > 0) {
            throw ValidationException::create($errors);
        }

        $vine->update($vineDTO->name, $vineDTO->grapes);

        $this->entityManager->persist($vine);
        $this->entityManager->flush();

        return [
            'id' => $vine->id()
        ];
    }
}