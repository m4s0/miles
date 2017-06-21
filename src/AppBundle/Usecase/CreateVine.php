<?php

namespace AppBundle\Usecase;

use AppBundle\DTO\VineDTO;
use AppBundle\Entity\Vine;
use AppBundle\Exception\DomainException;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class CreateVine
 *
 * @package AppBundle\Usecase
 */
class CreateVine
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
     * CreateVine constructor.
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
     * @param VineDTO $vineDTO
     *
     * @return array
     * @throws DomainException
     */
    public function execute(VineDTO $vineDTO): array
    {
        $errors = $this->validator->validate($vineDTO);
        if (count($errors) > 0) {
            throw DomainException::create($errors);
        }

        $vine = Vine::create($vineDTO->name, $vineDTO->grapes);

        $this->entityManager->persist($vine);
        $this->entityManager->flush();

        return [
            'id' => $vine->id()
        ];
    }
}