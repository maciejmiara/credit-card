<?php

declare(strict_types = 1);

namespace Application\Command;

use Common\Id;

class Withdraw
{
    /** @var Id */
    private $cardId;

    /** @var int */
    private $amount;

    /**
     * @param Id $cardId
     * @param int $amount
     */
    public function __construct(
        Id $cardId,
        int $amount
    ) {
        $this->cardId = $cardId;
        $this->amount = $amount;
    }

    /**
     * @return Id
     */
    public function getCardId(): Id
    {
        return $this->cardId;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }
}
