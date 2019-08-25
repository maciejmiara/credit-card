<?php

declare(strict_types = 1);

namespace Domain\Exception;

use Domain\Model\CreditCard;

class LimitExceededException extends DomainException
{
    public static function forCard(CreditCard $card): self
    {
        return new self(sprintf('Limit exceeded for card with id %s', $card->getId()));
    }
}
