<?php

declare(strict_types = 1);

namespace Infrastructure\Doctrine\Transformer;

use Common\Id;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Infrastructure\Doctrine\Entity\Client as ClientEntity;
use Infrastructure\Doctrine\Entity\CreditCard as Entity;
use Domain\Model\CreditCard as Domain;

class CreditCardTransformer
{
    /** @var ClientTransformer */
    private $clientTransformer;

    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var ObjectRepository */
    private $entityRepository;

    /**
     * @param ClientTransformer $clientTransformer
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        ClientTransformer $clientTransformer,
        EntityManagerInterface $entityManager
    ) {
        $this->clientTransformer = $clientTransformer;
        $this->entityManager = $entityManager;
        $this->entityRepository = $entityManager->getRepository(Entity::class);
    }

    public function entityToDomain(Entity $entity): Domain
    {
        $clientDomain = $this->clientTransformer->entityToDomain($entity->getClient());

        return new Domain(Id::create($entity->getId()), $clientDomain, $entity->getLimit(), $entity->getAvailableAmount());
    }

    public function domainToEntity(Domain $domain): Entity
    {
        $clientDomain = $domain->getClient();
        $clientEntity = $this->entityManager->getReference(ClientEntity::class, (string)$domain->getClient()->getId());

        $entity = $this->entityRepository->find((string)$domain->getId());

        if (null !== $entity) {
            $entity->setLimit($domain->getLimit());
            $entity->setAvailableAmount($domain->getAvailableAmount());
        } else {
            $entity = new Entity((string)$domain->getId(), $clientEntity, $domain->getLimit(), $domain->getAvailableAmount());
        }

        return $entity;
    }
}
