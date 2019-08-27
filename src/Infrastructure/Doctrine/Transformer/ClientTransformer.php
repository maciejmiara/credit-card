<?php

declare(strict_types = 1);

namespace Infrastructure\Doctrine\Transformer;

use Common\Id;
use Infrastructure\Doctrine\Entity\Client as Entity;
use Domain\Model\Client as Domain;

class ClientTransformer
{
    /**
     * @param Entity $entity
     *
     * @return Domain
     * @throws \Common\Exception\InvalidIdException
     */
    public function entityToDomain(Entity $entity): Domain
    {
        return new Domain(Id::create($entity->getId()), $entity->getName());
    }

    /**
     * @param Domain $domain
     *
     * @return Entity
     */
    public function domainToEntity(Domain $domain): Entity
    {
        return new Entity((string)$domain->getId(), $domain->getName());
    }
}
