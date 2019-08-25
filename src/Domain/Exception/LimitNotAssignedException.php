<?php

declare(strict_types = 1);

namespace Domain\Exception;

use Domain\Model\CreditCard;

class LimitNotAssignedException extends DomainException
{
    public static function forCard(CreditCard $card): self
    {
        return new self(sprintf('Limit not assigned for card with id %s', $card->getId()));
    }
}
