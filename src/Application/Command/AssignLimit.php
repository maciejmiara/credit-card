<?php

declare(strict_types = 1);

namespace Application\Command;

use Common\Id;

class AssignLimit
{
    /** @var Id */
    private $cardId;

    /** @var int */
    private $limit;

    /**
     * @param Id $cardId
     * @param int $limit
     */
    public function __construct(
        Id $cardId,
        int $limit
    ) {
        $this->cardId = $cardId;
        $this->limit = $limit;
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
    public function getLimit(): int
    {
        return $this->limit;
    }
}
