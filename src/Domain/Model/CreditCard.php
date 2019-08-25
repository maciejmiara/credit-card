<?php

declare(strict_types = 1);

namespace Domain\Model;

use Common\Id;
use Domain\Exception\LimitAlreadyAssignedException;
use Domain\Exception\LimitExceededException;
use Domain\Exception\LimitNotAssignedException;

class CreditCard
{
    /** @var Id */
    private $id;

    /** @var Client */
    private $client;

    /** @var ?int */
    private $limit;

    /** @var int */
    private $availableAmount;

    /**
     * @param Id $id
     * @param Client $client
     */
    public function __construct(Id $id, Client $client)
    {
        $this->id = $id;
        $this->client = $client;
    }

    /**
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @param int $limit
     *
     * @throws LimitAlreadyAssignedException
     */
    public function assignLimit(int $limit): void
    {
        if (null !== $this->limit) {
            throw LimitAlreadyAssignedException::forCard($this);
        }

        $this->limit = $limit;
        $this->availableAmount = $limit;
    }

    /**
     * @return int
     * @throws LimitNotAssignedException
     */
    public function getAvailableAmount(): int
    {
        if (null === $this->limit) {
            throw LimitNotAssignedException::forCard($this);
        }

        return $this->availableAmount;
    }

    /**
     * @param int $amount
     *
     * @throws LimitExceededException
     */
    public function withdraw(int $amount)
    {
        if ($amount > $this->availableAmount) {
            throw LimitExceededException::forCard($this);
        }

        $this->availableAmount -= $amount;
    }

    /**
     * @param int $amount
     */
    public function repay(int $amount)
    {
        $this->availableAmount += $amount;
    }
}
