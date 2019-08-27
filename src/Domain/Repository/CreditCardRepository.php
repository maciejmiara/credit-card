<?php

declare(strict_types = 1);

namespace Domain\Repository;

use Common\Id;
use Domain\Exception\CreditCardNotFoundException;
use Domain\Model\Client;
use Domain\Model\CreditCard;

interface CreditCardRepository
{
    /**
     * @param Id $id
     *
     * @throws CreditCardNotFoundException
     * @return CreditCard
     */
    public function getById(Id $id): CreditCard;

    /**
     * @return CreditCard[]
     */
    public function findAll(): array;

    /**
     * @param CreditCard $card
     */
    public function save(CreditCard $card): void;
}
