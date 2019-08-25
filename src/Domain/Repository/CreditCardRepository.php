<?php

declare(strict_types = 1);

namespace Domain\Repository;

use Common\Id;
use Domain\Model\Client;
use Domain\Model\CreditCard;

interface CreditCardRepository
{
    /**
     * @param Id $id
     *
     * @return CreditCard|null
     */
    public function findById(Id $id): ?CreditCard;

    /**
     * @param Client $client
     *
     * @return CreditCard[]
     */
    public function findByClient(Client $client): array;
}
