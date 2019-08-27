<?php

declare(strict_types = 1);

namespace Infrastructure\Doctrine\Repository;

use Common\Id;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Domain\Exception\CreditCardNotFoundException;
use Domain\Model\Client;
use Domain\Model\CreditCard;
use Infrastructure\Doctrine\Transformer\CreditCardTransformer;

class CreditCardRepository implements \Domain\Repository\CreditCardRepository
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var ObjectRepository */
    private $entityRepository;

    /** @var CreditCardTransformer */
    private $creditCardTransformer;

    /**
     * @param EntityManagerInterface $entityManager
     * @param ObjectRepository $entityRepository
     * @param CreditCardTransformer $creditCardTransformer
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        CreditCardTransformer $creditCardTransformer
    ) {
        $this->entityManager = $entityManager;
        $this->entityRepository = $entityManager->getRepository(\Infrastructure\Doctrine\Entity\CreditCard::class);
        $this->creditCardTransformer = $creditCardTransformer;
    }

    /**
     * @inheritDoc
     */
    public function getById(Id $id): CreditCard
    {
        $creditCard = $this->entityRepository->find((string)$id);

        if (!$creditCard) {
            throw CreditCardNotFoundException::forId($id);
        }

        return $this->creditCardTransformer->entityToDomain($creditCard);
    }

    /**
     * @return CreditCard[]
     */
    public function findAll(): array
    {
        $cards = $this->entityRepository->findAll();
        $domainCards = [];

        foreach ($cards as $card) {
            $domainCards[] = $this->creditCardTransformer->entityToDomain($card);
        }

        return $domainCards;
    }

    /**
     * @param CreditCard $card
     */
    public function save(CreditCard $card): void
    {
        $entityCard = $this->creditCardTransformer->domainToEntity($card);

        $this->entityManager->persist($entityCard);
    }
}
