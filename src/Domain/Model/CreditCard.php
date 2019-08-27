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

    /** @var int|null */
    private $limit;

    /** @var int|null */
    private $availableAmount;

    /**
     * @param Id $id
     * @param Client $client
     * @param int|null $limit
     * @param int|null $availableAmount
     */
    public function __construct(Id $id, Client $client, ?int $limit = null, ?int $availableAmount = null)
    {
        $this->id = $id;
        $this->client = $client;
        $this->limit = $limit;
        $this->availableAmount = $availableAmount;
    }

    /**
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @return int|null
     */
    public function getLimit(): ?int
    {
        return $this->limit;
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
     */
    public function getAvailableAmount(): ?int
    {
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
